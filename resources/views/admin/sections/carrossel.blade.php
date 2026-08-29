@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">Carrossel de imagens (pagina inicial)</h1>
    <p class="text-muted">Adicione, remova ou substitua as imagens que aparecem no carrossel do topo da pagina inicial. A legenda e opcional.</p>

    <form method="POST" action="{{ route('admin.carrossel.update') }}" enctype="multipart/form-data">
        @csrf

        <div id="slides-wrap">
            @foreach($content['slides'] as $i => $slide)
                <div class="repeat-row">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-2 text-center">
                            <img src="{{ asset($slide['imagem']) }}" alt="" class="rounded mb-1" style="width:100%;height:70px;object-fit:cover;">
                        </div>
                        <div class="col-md-7">
                            <label class="form-label">Legenda (opcional)</label>
                            <input type="text" name="slides[{{ $i }}][legenda]" class="form-control" value="{{ $slide['legenda'] }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Nova imagem (opcional)</label>
                            <input type="file" name="slides[{{ $i }}][imagem_arquivo]" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-outline-danger w-100 remove-row">X</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-slide" class="btn btn-outline-secondary btn-sm mb-4">+ Adicionar imagem</button>

        <template id="slide-template">
            <div class="repeat-row">
                <div class="row g-2 align-items-end">
                    <div class="col-md-2 text-center text-muted small">Sem imagem ainda</div>
                    <div class="col-md-7">
                        <label class="form-label">Legenda (opcional)</label>
                        <input type="text" name="slides[__INDEX__][legenda]" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Imagem</label>
                        <input type="file" name="slides[__INDEX__][imagem_arquivo]" class="form-control" accept="image/*" required>
                    </div>
                    <div class="col-md-1">
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
            const wrap = document.getElementById('slides-wrap');
            const tpl = document.getElementById('slide-template');
            // Contador que so cresce, nunca reaproveita indice de uma linha removida
            // (evita colidir com o indice de outra imagem e apagar ela por engano).
            let nextIndex = {{ count($content['slides']) }};

            document.getElementById('add-slide').addEventListener('click', function () {
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
