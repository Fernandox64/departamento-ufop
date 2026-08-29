@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">Sobre o departamento</h1>

    <form method="POST" action="{{ route('admin.sobre.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Titulo</label>
                <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $content['titulo']) }}" required>
            </div>
            <div class="col-12">
                <label class="form-label">Texto de introducao (destaque)</label>
                <textarea name="texto_intro" class="form-control" rows="2">{{ old('texto_intro', $content['texto_intro']) }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Texto completo</label>
                <textarea name="texto_corpo" class="form-control" rows="8">{{ old('texto_corpo', $content['texto_corpo']) }}</textarea>
                <small class="text-muted">Use uma linha em branco para separar paragrafos.</small>
            </div>

            <div class="col-12">
                <label class="form-label">Imagem</label>
                <div class="mb-2"><img src="{{ asset($content['imagem']) }}" alt="Imagem atual" style="max-height:120px;" class="rounded"></div>
                <input type="file" name="imagem_arquivo" class="form-control" accept="image/*">
            </div>
        </div>

        <hr class="my-4">
        <h2 class="h6 mb-3">Lista de destaques (pontos rapidos)</h2>

        <div id="destaques-wrap">
            @foreach($content['destaques'] as $item)
                <div class="input-group mb-2">
                    <input type="text" name="destaques[]" class="form-control" value="{{ $item }}">
                    <button type="button" class="btn btn-outline-danger remove-row">X</button>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-destaque" class="btn btn-outline-secondary btn-sm mb-4">+ Adicionar item</button>

        <div>
            <button type="submit" class="btn btn-primary">Salvar alteracoes</button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        (function () {
            const wrap = document.getElementById('destaques-wrap');
            document.getElementById('add-destaque').addEventListener('click', function () {
                wrap.insertAdjacentHTML('beforeend', `
                    <div class="input-group mb-2">
                        <input type="text" name="destaques[]" class="form-control">
                        <button type="button" class="btn btn-outline-danger remove-row">X</button>
                    </div>
                `);
            });
            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-row')) {
                    e.target.closest('.input-group').remove();
                }
            });
        })();
    </script>
@endpush
