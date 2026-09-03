<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use ZipArchive;

/**
 * Gera um .zip com todo o conteudo editavel do site (JSON + imagens/anexos
 * enviados) para o admin baixar no proprio computador, e restaura o site a
 * partir de um desses arquivos quando necessario. Nao guarda historico no
 * servidor de proposito — a copia "de verdade" fica com o admin, fora do
 * servidor (se o servidor for comprometido, o backup nao vai junto).
 */
class BackupManager
{
    /**
     * Cria o .zip num arquivo temporario e devolve o caminho completo.
     * Quem chama e responsavel por apagar o arquivo depois de enviar.
     */
    public static function createZip(): string
    {
        $tmpDir = storage_path('app/private/tmp-backups');
        if (! is_dir($tmpDir)) {
            mkdir($tmpDir, 0755, true);
        }

        $zipPath = $tmpDir.'/backup-site-'.now()->format('Y-m-d-His').'.zip';

        $zip = new ZipArchive();
        $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach (glob(ContentStore::directory().'/*.json') as $file) {
            $zip->addFile($file, 'content/'.basename($file));
        }

        foreach (glob(storage_path('app/public/uploads/*')) as $file) {
            if (is_file($file)) {
                $zip->addFile($file, 'uploads/'.basename($file));
            }
        }

        $zip->close();

        return $zipPath;
    }

    /**
     * Substitui todo o conteudo atual (content/ e uploads/) pelo que estiver
     * dentro do .zip enviado. Antes de apagar qualquer coisa, guarda uma
     * copia de seguranca do estado atual no servidor (nao substitui o habito
     * de manter backups na sua propria maquina, e so uma rede de protecao
     * extra contra restaurar o arquivo errado por engano).
     *
     * @throws \RuntimeException se o arquivo nao for um .zip valido ou nao
     *         tiver a estrutura esperada (pasta content/ e/ou uploads/).
     */
    public static function restoreZip(UploadedFile $file): void
    {
        $zip = new ZipArchive();
        if ($zip->open($file->getRealPath()) !== true) {
            throw new \RuntimeException('Arquivo de backup invalido ou corrompido.');
        }

        $entradasValidas = 0;
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $nome = $zip->getNameIndex($i);
            if (self::destinoSeguro($nome) !== null) {
                $entradasValidas++;
            }
        }

        if ($entradasValidas === 0) {
            $zip->close();
            throw new \RuntimeException('Esse arquivo nao parece ser um backup valido deste site (nao encontrei nenhum arquivo dentro de content/ ou uploads/).');
        }

        self::criarCopiaDeSeguranca();

        self::limparPasta(ContentStore::directory(), '*.json');
        self::limparPasta(storage_path('app/public/uploads'), '*');

        for ($i = 0; $i < $zip->numFiles; $i++) {
            $nome = $zip->getNameIndex($i);
            $destino = self::destinoSeguro($nome);

            if ($destino === null) {
                continue;
            }

            file_put_contents($destino, $zip->getFromIndex($i));
        }

        $zip->close();
    }

    /**
     * Converte o nome de uma entrada do zip no caminho real de destino,
     * ou null se a entrada for invalida/perigosa (protecao contra
     * "zip slip" - entradas que tentam escapar da pasta de destino).
     */
    protected static function destinoSeguro(string $nomeNoZip): ?string
    {
        if (str_contains($nomeNoZip, '..') || str_starts_with($nomeNoZip, '/') || str_contains($nomeNoZip, '\\')) {
            return null;
        }

        if (str_starts_with($nomeNoZip, 'content/') && str_ends_with($nomeNoZip, '.json')) {
            return ContentStore::directory().'/'.basename($nomeNoZip);
        }

        if (str_starts_with($nomeNoZip, 'uploads/')) {
            $base = basename($nomeNoZip);
            if ($base === '' || $base === '.gitkeep') {
                return null;
            }

            return storage_path('app/public/uploads/'.$base);
        }

        return null;
    }

    protected static function limparPasta(string $pasta, string $padrao): void
    {
        foreach (glob($pasta.'/'.$padrao) as $arquivo) {
            if (is_file($arquivo)) {
                unlink($arquivo);
            }
        }
    }

    protected static function criarCopiaDeSeguranca(): void
    {
        $pasta = storage_path('app/private/backups-seguranca');
        if (! is_dir($pasta)) {
            mkdir($pasta, 0755, true);
        }

        $zipPath = $pasta.'/antes-de-restaurar-'.now()->format('Y-m-d-His').'.zip';

        $zip = new ZipArchive();
        $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach (glob(ContentStore::directory().'/*.json') as $file) {
            $zip->addFile($file, 'content/'.basename($file));
        }
        foreach (glob(storage_path('app/public/uploads/*')) as $file) {
            if (is_file($file)) {
                $zip->addFile($file, 'uploads/'.basename($file));
            }
        }

        $zip->close();
    }
}
