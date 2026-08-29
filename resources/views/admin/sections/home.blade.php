@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">Pagina inicial</h1>

    <form method="POST" action="{{ route('admin.home.update') }}">
        @csrf

        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Titulo principal (destaque grande)</label>
                <input type="text" name="hero_titulo" class="form-control" value="{{ old('hero_titulo', $content['hero_titulo']) }}" required>
            </div>
            <div class="col-12">
                <label class="form-label">Subtitulo</label>
                <textarea name="hero_subtitulo" class="form-control" rows="2">{{ old('hero_subtitulo', $content['hero_subtitulo']) }}</textarea>
            </div>

            <div class="col-12"><hr></div>

            <div class="col-md-4">
                <label class="form-label">Titulo da secao "Quem somos"</label>
                <input type="text" name="sobre_titulo" class="form-control" value="{{ old('sobre_titulo', $content['sobre_titulo']) }}">
            </div>
            <div class="col-md-8">
                <label class="form-label">Texto curto sobre o departamento</label>
                <textarea name="sobre_texto" class="form-control" rows="2">{{ old('sobre_texto', $content['sobre_texto']) }}</textarea>
            </div>
        </div>

        <hr class="my-4">
        <h2 class="h6 mb-3">Destaques da pagina inicial (cards com icone)</h2>

        <div id="destaques-wrap">
            @foreach($content['destaques'] as $i => $item)
                <div class="repeat-row">
                    <div class="row g-2">
                        <div class="col-md-3">
                            <label class="form-label">Icone</label>
                            <select name="destaques[{{ $i }}][icone]" class="form-select">
                                @include('admin.partials.icon-options', ['valorAtual' => $item['icone']])
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Titulo</label>
                            <input type="text" name="destaques[{{ $i }}][titulo]" class="form-control" value="{{ $item['titulo'] }}">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Texto</label>
                            <input type="text" name="destaques[{{ $i }}][texto]" class="form-control" value="{{ $item['texto'] }}">
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-outline-danger w-100 remove-row">X</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-destaque" class="btn btn-outline-secondary btn-sm mb-4">+ Adicionar destaque</button>

        <template id="destaque-template">
            <div class="repeat-row">
                <div class="row g-2">
                    <div class="col-md-3">
                        <label class="form-label">Icone</label>
                        <select name="destaques[__INDEX__][icone]" class="form-select">
                            @include('admin.partials.icon-options', ['valorAtual' => ''])
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Titulo</label>
                        <input type="text" name="destaques[__INDEX__][titulo]" class="form-control">
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Texto</label>
                        <input type="text" name="destaques[__INDEX__][texto]" class="form-control">
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-outline-danger w-100 remove-row">X</button>
                    </div>
                </div>
            </div>
        </template>

        <div>
            <button type="submit" class="btn btn-primary">Salvar alteracoes</button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        (function () {
            const wrap = document.getElementById('destaques-wrap');
            const addBtn = document.getElementById('add-destaque');
            const tpl = document.getElementById('destaque-template');
            // Contador que so cresce, nunca reaproveita indice de uma linha removida.
            let nextIndex = {{ count($content['destaques']) }};

            addBtn.addEventListener('click', function () {
                const html = tpl.innerHTML.replaceAll('__INDEX__', nextIndex);
                nextIndex++;
                wrap.insertAdjacentHTML('beforeend', html);
            });

            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-row')) {
                    e.target.closest('.repeat-row').remove();
                }
            });
        })();
    </script>
@endpush
