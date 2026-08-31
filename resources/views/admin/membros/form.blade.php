@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">{{ $item ? 'Editar membro' : 'Novo membro' }}</h1>

    <form method="POST" action="{{ $item ? route('admin.membros.update', $item['id']) : route('admin.membros.store') }}">
        @csrf
        @if($item)
            @method('PUT')
        @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ old('nome', $item['nome'] ?? '') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">E-mail (usado para login)</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $item['email'] ?? '') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Nivel de permissao</label>
                <select name="nivel" class="form-select" required>
                    <option value="secretaria" @selected(old('nivel', $item['nivel'] ?? 'secretaria') === 'secretaria')>Secretaria (edita o conteudo do site)</option>
                    <option value="administrador" @selected(old('nivel', $item['nivel'] ?? '') === 'administrador')>Administrador (acesso total)</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">{{ $item ? 'Nova senha (deixe em branco para manter a atual)' : 'Senha' }}</label>
                <input type="password" name="senha" class="form-control" minlength="8" {{ $item ? '' : 'required' }}>
                <small class="text-muted">Minimo de 8 caracteres.</small>
            </div>
        </div>

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">{{ $item ? 'Salvar alteracoes' : 'Criar membro' }}</button>
            <a href="{{ route('admin.membros.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
@endsection
