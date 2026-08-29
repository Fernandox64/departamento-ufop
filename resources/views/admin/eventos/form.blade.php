@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">{{ $item ? 'Editar evento' : 'Novo evento' }}</h1>

    <form method="POST" action="{{ $item ? route('admin.eventos.update', $item['id']) : route('admin.eventos.store') }}">
        @csrf
        @if($item)
            @method('PUT')
        @endif

        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Titulo</label>
                <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $item['titulo'] ?? '') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Data do evento</label>
                <input type="date" name="data_evento" class="form-control" value="{{ old('data_evento', $item['data_evento'] ?? '') }}" required>
            </div>
            <div class="col-12">
                <label class="form-label">Local (opcional)</label>
                <input type="text" name="local" class="form-control" value="{{ old('local', $item['local'] ?? '') }}">
            </div>
            <div class="col-12">
                <label class="form-label">Descricao (opcional)</label>
                <textarea name="descricao" class="form-control" rows="3">{{ old('descricao', $item['descricao'] ?? '') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Link com mais informacoes (opcional)</label>
                <input type="text" name="link" class="form-control" value="{{ old('link', $item['link'] ?? '') }}" placeholder="https://...">
            </div>
        </div>

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">{{ $item ? 'Salvar alteracoes' : 'Criar evento' }}</button>
            <a href="{{ route('admin.eventos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
@endsection
