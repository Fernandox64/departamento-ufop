@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">{{ $tituloPagina }}</h1>

    <form method="POST" action="{{ route($updateRoute) }}">
        @csrf

        <div class="row g-3 mb-3">
            <div class="col-md-8">
                <label class="form-label">Titulo da pagina</label>
                <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $content['titulo']) }}" required>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <div class="form-check">
                    <input type="checkbox" name="mostrar_menu" value="1" class="form-check-input" id="mostrar_menu" @checked(old('mostrar_menu', $content['mostrar_menu']))>
                    <label class="form-check-label" for="mostrar_menu">Mostrar no menu principal</label>
                </div>
            </div>
            <div class="col-12">
                <label class="form-label">Texto de introducao</label>
                <textarea name="texto_intro" class="form-control" rows="2">{{ old('texto_intro', $content['texto_intro']) }}</textarea>
            </div>
        </div>

        <h2 class="h6 mb-3">Cursos / programas</h2>

        <div id="cursos-wrap">
            @foreach($content['cursos'] as $i => $curso)
                <div class="repeat-row">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label">Nome do curso</label>
                            <input type="text" name="cursos[{{ $i }}][nome]" class="form-control" value="{{ $curso['nome'] }}">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Link (site do curso, SIGAA, editais...)</label>
                            <input type="text" name="cursos[{{ $i }}][link]" class="form-control" value="{{ $curso['link'] }}" placeholder="https://...">
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-outline-danger w-100 remove-row">X</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-curso" class="btn btn-outline-secondary btn-sm mb-4">+ Adicionar curso</button>

        <template id="curso-template">
            <div class="repeat-row">
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label">Nome do curso</label>
                        <input type="text" name="cursos[__INDEX__][nome]" class="form-control">
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Link (site do curso, SIGAA, editais...)</label>
                        <input type="text" name="cursos[__INDEX__][link]" class="form-control" placeholder="https://...">
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
            const wrap = document.getElementById('cursos-wrap');
            const tpl = document.getElementById('curso-template');
            let nextIndex = {{ count($content['cursos']) }};

            document.getElementById('add-curso').addEventListener('click', function () {
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
