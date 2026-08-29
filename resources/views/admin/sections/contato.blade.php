@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">Contato</h1>

    <form method="POST" action="{{ route('admin.contato.update') }}">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Titulo da pagina</label>
                <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $content['titulo']) }}" required>
            </div>
            <div class="col-12">
                <label class="form-label">Texto de introducao</label>
                <textarea name="texto_intro" class="form-control" rows="2">{{ old('texto_intro', $content['texto_intro']) }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Endereco</label>
                <input type="text" name="endereco" class="form-control" value="{{ old('endereco', $content['endereco']) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Telefone 1</label>
                <input type="text" name="telefone_1" class="form-control" value="{{ old('telefone_1', $content['telefone_1']) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Telefone 2 (opcional)</label>
                <input type="text" name="telefone_2" class="form-control" value="{{ old('telefone_2', $content['telefone_2']) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">E-mail 1</label>
                <input type="email" name="email_1" class="form-control" value="{{ old('email_1', $content['email_1']) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">E-mail 2 (opcional)</label>
                <input type="email" name="email_2" class="form-control" value="{{ old('email_2', $content['email_2']) }}">
            </div>

            <div class="col-12">
                <label class="form-label">Link do mapa (Google Maps &rarr; Compartilhar &rarr; Incorporar um mapa &rarr; copiar o endereco do "src")</label>
                <input type="text" name="mapa_embed_url" class="form-control" value="{{ old('mapa_embed_url', $content['mapa_embed_url']) }}" placeholder="https://www.google.com/maps/embed?...">
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Salvar alteracoes</button>
    </form>
@endsection
