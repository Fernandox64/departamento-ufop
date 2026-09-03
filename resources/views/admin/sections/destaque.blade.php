@extends('admin.layout')

@section('content')
    @php
        $slides = !empty($content['slides']) && is_array($content['slides'])
            ? array_values($content['slides'])
            : (!empty($content['imagem'])
                ? [[
                    'imagem' => $content['imagem'],
                    'legenda' => $content['legenda'] ?? '',
                    'texto' => $content['texto'] ?? '',
                    'link' => $content['link'] ?? '',
                ]]
                : []);
    @endphp

    <h1 class="h4 mb-4">Imagens de destaque</h1>

    <p class="text-muted">
        Edite as imagens grandes exibidas a esquerda na secao de ultimas noticias da pagina inicial.
        Ao lado delas aparecem as 3 ultimas noticias.
    </p>

    <form method="POST" action="{{ route('admin.destaque.update') }}" enctype="multipart/form-data">
        @csrf

        <div id="slides-wrap">
            @foreach($slides as $i => $slide)
                <div class="repeat-row">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-2 text-center">
                            <img src="{{ asset($slide['imagem']) }}" alt="" class="rounded mb-1" style="width:100%;height:90px;object-fit:cover;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Legenda (opcional)</label>
                            <input type="text" name="slides[{{ $i }}][legenda]" class="form-control" value="{{ $slide['legenda'] ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Link (opcional)</label>
                            <input type="text" name="slides[{{ $i }}][link]" class="form-control" value="{{ $slide['link'] ?? '' }}" placeholder="https://...">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Nova imagem</label>
                            <input type="file" name="slides[{{ $i }}][imagem_arquivo]" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-outline-danger w-100 remove-row">X</button>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Texto abaixo da imagem</label>
                            <textarea name="slides[{{ $i }}][texto]" class="form-control" rows="2">{{ $slide['texto'] ?? '' }}</textarea>
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
                    <div class="col-md-4">
                        <label class="form-label">Legenda (opcional)</label>
                        <input type="text" name="slides[__INDEX__][legenda]" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Link (opcional)</label>
                        <input type="text" name="slides[__INDEX__][link]" class="form-control" placeholder="https://...">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Imagem</label>
                        <input type="file" name="slides[__INDEX__][imagem_arquivo]" class="form-control" accept="image/*" required>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-outline-danger w-100 remove-row">X</button>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Texto abaixo da imagem</label>
                        <textarea name="slides[__INDEX__][texto]" class="form-control" rows="2"></textarea>
                    </div>
                </div>
            </div>
        </template>

        <div>
            <button type="submit" class="btn btn-primary">Salvar imagens</button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        (function () {
            const wrap = document.getElementById('slides-wrap');
            const tpl = document.getElementById('slide-template');
            let nextIndex = {{ count($slides) }};

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
