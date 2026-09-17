<?php

namespace App\Console\Commands;

use App\Support\ImageUploader;
use App\Support\NoticiaStore;
use Illuminate\Console\Command;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use RuntimeException;
use Throwable;

/**
 * Importa noticias/editais em lote a partir de um JSON, para migrar o
 * acervo de um site antigo sem reentrada manual pelo painel.
 *
 * Formato esperado do arquivo (array de objetos):
 * [{"tipo":"noticia|edital","titulo":"...","resumo":"...","conteudo":"...",
 *   "data_publicacao":"AAAA-MM-DD","imagem":"URL http(s) ou caminho local
 *   (opcional)","anexo":"URL http(s) ou caminho local (opcional)"}]
 *
 * "imagem"/"anexo" aceitam tanto uma URL http(s) (baixada na hora) quanto um
 * caminho de arquivo local — absoluto, ou relativo a pasta onde esta o JSON.
 */
class ImportarNoticias extends Command
{
    protected $signature = 'noticias:importar
        {arquivo : Caminho para o JSON com as noticias a importar}
        {--dry-run : So valida e mostra o que seria importado, sem salvar nada}';

    protected $description = 'Importa noticias/editais em lote a partir de um arquivo JSON (migracao de site antigo)';

    public function handle(): int
    {
        $caminho = $this->argument('arquivo');

        if (! is_file($caminho)) {
            $this->error("Arquivo nao encontrado: {$caminho}");

            return self::FAILURE;
        }

        $itens = json_decode((string) file_get_contents($caminho), true);

        if (! is_array($itens)) {
            $this->error('O arquivo nao contem um JSON valido (esperado um array de objetos).');

            return self::FAILURE;
        }

        $dryRun = (bool) $this->option('dry-run');
        $baseDir = dirname($caminho);
        $importados = 0;
        $comErro = 0;

        foreach ($itens as $indice => $item) {
            $numero = $indice + 1;
            $titulo = trim((string) ($item['titulo'] ?? ''));

            try {
                $dados = $this->validarItem(is_array($item) ? $item : []);
            } catch (ValidationException $e) {
                $comErro++;
                $this->error("[{$numero}] \"{$titulo}\": ".implode(' ', $e->validator->errors()->all()));

                continue;
            }

            if ($dryRun) {
                $this->line("[{$numero}] OK (dry-run): {$dados['titulo']} ({$dados['tipo']}, {$dados['data_publicacao']})");
                $importados++;

                continue;
            }

            try {
                $dados['imagem'] = $this->resolverArquivo($item['imagem'] ?? null, $baseDir);
                $dados['anexo'] = $this->resolverArquivo($item['anexo'] ?? null, $baseDir);
            } catch (Throwable $e) {
                $comErro++;
                $this->error("[{$numero}] \"{$titulo}\": falha ao processar arquivo — {$e->getMessage()}");

                continue;
            }

            NoticiaStore::save($dados);
            $importados++;
            $this->info("[{$numero}] Importado: {$dados['titulo']}");
        }

        $this->newLine();
        $this->comment("Total: {$importados} importadas, {$comErro} com erro, ".count($itens).' no arquivo.');

        return $comErro > 0 ? self::FAILURE : self::SUCCESS;
    }

    /**
     * Mesmas regras usadas no formulario manual de /admin/noticias.
     */
    protected function validarItem(array $item): array
    {
        $validador = validator($item, [
            'tipo' => ['required', 'in:noticia,edital'],
            'titulo' => ['required', 'string', 'max:180'],
            'resumo' => ['required', 'string', 'max:300'],
            'conteudo' => ['required', 'string', 'max:8000'],
            'data_publicacao' => ['required', 'date'],
        ]);

        $validador->validate();

        return [
            'tipo' => $item['tipo'],
            'titulo' => $item['titulo'],
            'resumo' => $item['resumo'],
            'conteudo' => $item['conteudo'],
            'data_publicacao' => $item['data_publicacao'],
        ];
    }

    /**
     * Aceita URL http(s) (baixa para um arquivo temporario) ou caminho local,
     * e delega para o ImageUploader - mesma validacao/antivirus/nome aleatorio
     * usados no upload manual pelo painel.
     */
    protected function resolverArquivo(?string $origem, string $baseDir): string
    {
        $origem = trim((string) $origem);

        if ($origem === '') {
            return '';
        }

        if (Str::startsWith($origem, ['http://', 'https://'])) {
            $resposta = Http::timeout(30)->get($origem);

            if (! $resposta->successful()) {
                throw new RuntimeException("download falhou ({$resposta->status()}): {$origem}");
            }

            $nomeOriginal = basename(parse_url($origem, PHP_URL_PATH) ?: 'arquivo') ?: 'arquivo';
            $temp = tempnam(sys_get_temp_dir(), 'import_').'_'.$nomeOriginal;
            file_put_contents($temp, $resposta->body());
        } else {
            $ehAbsoluto = Str::startsWith($origem, ['/', '\\']) || preg_match('/^[a-zA-Z]:[\\\\\/]/', $origem);
            $temp = $ehAbsoluto ? $origem : $baseDir.DIRECTORY_SEPARATOR.$origem;

            if (! is_file($temp)) {
                throw new RuntimeException("arquivo local nao encontrado: {$temp}");
            }

            $nomeOriginal = basename($temp);
        }

        $uploaded = new UploadedFile($temp, $nomeOriginal, mime_content_type($temp) ?: null, null, true);

        return ImageUploader::store($uploaded);
    }
}
