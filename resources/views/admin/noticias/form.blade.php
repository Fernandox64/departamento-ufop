@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">{{ $item ? 'Editar publicacao' : 'Nova publicacao' }}</h1>

    <form method="POST" action="{{ $item ? route('admin.noticias.update', $item['id']) : route('admin.noticias.store') }}" enctype="multipart/form-data">
        @csrf
        @if($item)
            @method('PUT')
        @endif

        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Tipo</label>
                <select name="tipo" class="form-select" required>
                    <option value="noticia" @selected(old('tipo', $item['tipo'] ?? 'noticia') === 'noticia')>Noticia</option>
                    <option value="edital" @selected(old('tipo', $item['tipo'] ?? '') === 'edital')>Edital</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Data de publicacao</label>
                <input type="date" name="data_publicacao" class="form-control" value="{{ old('data_publicacao', $item['data_publicacao'] ?? now()->format('Y-m-d')) }}" required>
            </div>

            <div class="col-12">
                <label class="form-label">Titulo</label>
                <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $item['titulo'] ?? '') }}" required>
            </div>

            <div class="col-12">
                <label class="form-label">Resumo (aparece nos cards e na listagem)</label>
                <textarea name="resumo" class="form-control" rows="2" required>{{ old('resumo', $item['resumo'] ?? '') }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Conteudo completo</label>
                <textarea name="conteudo" class="form-control" rows="10" required>{{ old('conteudo', $item['conteudo'] ?? '') }}</textarea>
                <small class="text-muted">Use uma linha em branco para separar paragrafos.</small>
            </div>

            <div class="col-md-6">
                <label class="form-label">Imagem (opcional)</label>
                @if(!empty($item['imagem']))
                    <div class="mb-2"><img src="{{ asset($item['imagem']) }}" alt="" style="max-height:100px;" class="rounded"></div>
                @endif
                <input type="file" name="imagem_arquivo" class="form-control" accept="image/*">
            </div>

            <div class="col-md-6">
                <label class="form-label">Anexo (PDF, Word ou Excel — opcional, util para editais)</label>
                @if(!empty($item['anexo']))
                    <div class="mb-2"><a href="{{ asset($item['anexo']) }}" target="_blank" rel="noopener">Ver anexo atual</a></div>
                @endif
                <input type="file" name="anexo_arquivo" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx">
            </div>
        </div>

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">{{ $item ? 'Salvar alteracoes' : 'Publicar' }}</button>
            <a href="{{ route('admin.noticias.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
@endsection
