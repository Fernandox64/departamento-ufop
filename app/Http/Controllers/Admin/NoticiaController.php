<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\ImageUploader;
use App\Support\NoticiaStore;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index()
    {
        $items = NoticiaStore::all();

        return view('admin.noticias.index', compact('items'));
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
