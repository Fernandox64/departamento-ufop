<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\ImageUploader;
use App\Support\NoticiaStore;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class NoticiaController extends Controller
{
    /** Linhas por pagina na tabela do painel. */
    protected const POR_PAGINA = 25;

    public function index(Request $request)
    {
        // A tabela nunca carrega o acervo inteiro: filtra por tipo e por ano e
        // ainda pagina o resultado. Com muitas publicacoes, montar tudo de uma
        // vez gerava uma pagina de varios MB a cada acesso.
        $tipo = $request->query('tipo');
        $doTipo = NoticiaStore::byTipo($tipo);

        // Anos vem do conjunto ja filtrado por tipo: todo ano oferecido tem
        // pelo menos uma publicacao daquele tipo.
        $anos = NoticiaStore::anos($doTipo);

        $anoParam = (string) $request->query('ano', '');
        if ($anoParam === 'todos') {
            $anoSelecionado = 'todos';
            $items = $doTipo;
        } else {
            $ano = (int) $anoParam;
            if (! in_array($ano, $anos, true)) {
                $ano = $anos[0] ?? 0;   // sem ano valido na URL, abre no mais recente
            }
            $anoSelecionado = $ano;
            $items = $ano ? NoticiaStore::byAno($doTipo, $ano) : [];
        }

        $total = count($items);
        $ultima = max(1, (int) ceil($total / self::POR_PAGINA));
        $pagina = min(max(1, (int) $request->query('pagina', 1)), $ultima);

        $paginator = new LengthAwarePaginator(
            array_slice($items, ($pagina - 1) * self::POR_PAGINA, self::POR_PAGINA),
            $total,
            self::POR_PAGINA,
            $pagina,
            [
                'path' => $request->url(),
                'pageName' => 'pagina',
                'query' => $request->except('pagina'),
            ]
        );

        return view('admin.noticias.index', [
            'items' => $paginator,
            'tipo' => $tipo,
            'anos' => $anos,
            'anoSelecionado' => $anoSelecionado,
            'total' => $total,
        ]);
    }

    public function create()
    {
        $item = null;

        return view('admin.noticias.form', compact('item'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['imagem'] = ImageUploader::store($request->file('imagem_arquivo'), '');
        $data['anexo'] = ImageUploader::store($request->file('anexo_arquivo'), '');

        NoticiaStore::save($data);

        return redirect()->route('admin.noticias.index')->with('status', 'Publicado com sucesso.');
    }

    public function edit(string $id)
    {
        $item = NoticiaStore::find($id);

        abort_if(! $item, 404);

        return view('admin.noticias.form', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $atual = NoticiaStore::find($id);

        abort_if(! $atual, 404);

        $data = $this->validated($request);
        $data['id'] = $id;
        $data['imagem'] = ImageUploader::store($request->file('imagem_arquivo'), $atual['imagem'] ?? '');
        $data['anexo'] = ImageUploader::store($request->file('anexo_arquivo'), $atual['anexo'] ?? '');

        NoticiaStore::save($data);

        return redirect()->route('admin.noticias.index')->with('status', 'Atualizado com sucesso.');
    }

    public function destroy(string $id)
    {
        NoticiaStore::delete($id);

        return redirect()->route('admin.noticias.index')->with('status', 'Removido com sucesso.');
    }

    protected function validated(Request $request): array
    {
        $validated = $request->validate([
            'tipo' => ['required', 'in:noticia,edital'],
            'titulo' => ['required', 'string', 'max:180'],
            'resumo' => ['required', 'string', 'max:300'],
            'conteudo' => ['required', 'string', 'max:8000'],
            'data_publicacao' => ['required', 'date'],
            'imagem_arquivo' => ['nullable', 'image', 'max:4096'],
            'anexo_arquivo' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx', 'max:8192'],
        ]);

        return [
            'tipo' => $validated['tipo'],
            'titulo' => $validated['titulo'],
            'resumo' => $validated['resumo'],
            'conteudo' => $validated['conteudo'],
            'data_publicacao' => $validated['data_publicacao'],
        ];
    }
}
