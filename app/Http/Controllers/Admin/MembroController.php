<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\MembroStore;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MembroController extends Controller
{
    public function index()
    {
        $items = MembroStore::all();

        return view('admin.membros.index', compact('items'));
    }

    public function create()
    {
        $item = null;

        return view('admin.membros.form', compact('item'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, novo: true);

        MembroStore::save($data);

        return redirect()->route('admin.membros.index')->with('status', 'Membro criado com sucesso.');
    }

    public function edit(string $id)
    {
        $item = MembroStore::find($id);

        abort_if(! $item, 404);

        return view('admin.membros.form', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $atual = MembroStore::find($id);

        abort_if(! $atual, 404);

        $data = $this->validated($request, novo: false, idAtual: $id);
        $data['id'] = $id;

        MembroStore::save($data);

        return redirect()->route('admin.membros.index')->with('status', 'Membro atualizado com sucesso.');
    }

    public function destroy(string $id)
    {
        $item = MembroStore::find($id);

        abort_if(! $item, 404);

        if (strcasecmp($item['email'], (string) session('admin_email')) === 0) {
            return back()->withErrors(['membro' => 'Voce nao pode excluir a propria conta enquanto estiver logado com ela.']);
        }

        MembroStore::delete($id);

        return redirect()->route('admin.membros.index')->with('status', 'Membro removido.');
    }

    protected function validated(Request $request, bool $novo, ?string $idAtual = null): array
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:180'],
            'nivel' => ['required', 'in:administrador,secretaria'],
            'senha' => [$novo ? 'required' : 'nullable', 'string', 'min:8'],
        ]);

        if (strcasecmp($validated['email'], (string) config('admin.email')) === 0) {
            throw ValidationException::withMessages([
                'email' => 'Este e-mail ja e usado pela conta administradora principal (definida no .env).',
            ]);
        }

        $conflitante = MembroStore::findByEmail($validated['email']);
        if ($conflitante && $conflitante['id'] !== $idAtual) {
            throw ValidationException::withMessages(['email' => 'Ja existe um membro cadastrado com este e-mail.']);
        }

        return $validated;
    }
}
