<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\EventoStore;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $items = EventoStore::all();
        $mostrarMenu = EventoStore::mostrarMenu();

        return view('admin.eventos.index', compact('items', 'mostrarMenu'));
    }

    public function updateVisibilidade(Request $request)
    {
        EventoStore::setMostrarMenu($request->boolean('mostrar_menu'));

        return back()->with('status', 'Preferencia salva com sucesso.');
    }

    public function create()
    {
        $item = null;

        return view('admin.eventos.form', compact('item'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        EventoStore::save($data);

        return redirect()->route('admin.eventos.index')->with('status', 'Evento criado com sucesso.');
    }

    public function edit(string $id)
    {
        $item = EventoStore::find($id);

        abort_if(! $item, 404);

        return view('admin.eventos.form', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $atual = EventoStore::find($id);

        abort_if(! $atual, 404);

        $data = $this->validated($request);
        $data['id'] = $id;

        EventoStore::save($data);

        return redirect()->route('admin.eventos.index')->with('status', 'Evento atualizado com sucesso.');
    }

    public function destroy(string $id)
    {
        EventoStore::delete($id);

        return redirect()->route('admin.eventos.index')->with('status', 'Evento removido com sucesso.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'titulo' => ['required', 'string', 'max:180'],
            'data_evento' => ['required', 'date'],
            'local' => ['nullable', 'string', 'max:200'],
            'descricao' => ['nullable', 'string', 'max:1000'],
            'link' => ['nullable', 'string', 'max:500'],
        ]);
    }
}
