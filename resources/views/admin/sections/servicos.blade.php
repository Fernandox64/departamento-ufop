@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">Servicos</h1>

    <form method="POST" action="{{ route('admin.servicos.update') }}">
        @csrf

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <label class="form-label">Titulo da pagina</label>
                <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $content['titulo']) }}" required>
            </div>
            <div class="col-md-8">
                <label class="form-label">Texto de introducao</label>
                <textarea name="introducao" class="form-control" rows="2">{{ old('introducao', $content['introducao']) }}</textarea>
            </div>
        </div>

        <h2 class="h6 mb-3">Servicos oferecidos</h2>

        <div id="itens-wrap">
            @foreach($content['itens'] as $i => $item)
                <div class="repeat-row">
                    <div class="row g-2">
                        <div class="col-md-3">
                            <label class="form-label">Icone</label>
                            <select name="itens[{{ $i }}][icone]" class="form-select">
                                @include('admin.partials.icon-options', ['valorAtual' => $item['icone']])
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Titulo</label>
                            <input type="text" name="itens[{{ $i }}][titulo]" class="form-control" value="{{ $item['titulo'] }}">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Descricao</label>
                            <input type="text" name="itens[{{ $i }}][texto]" class="form-control" value="{{ $item['texto'] }}">
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-outline-danger w-100 remove-row">X</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-item" class="btn btn-outline-secondary btn-sm mb-4">+ Adicionar servico</button>

        <template id="item-template">
            <div class="repeat-row">
                <div class="row g-2">
                    <div class="col-md-3">
                        <label class="form-label">Icone</label>
                        <select name="itens[__INDEX__][icone]" class="form-select">
                            @include('admin.partials.icon-options', ['valorAtual' => ''])
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Titulo</label>
                        <input type="text" name="itens[__INDEX__][titulo]" class="form-control">
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Descricao</label>
                        <input type="text" name="itens[__INDEX__][texto]" class="form-control">
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
            const wrap = document.getElementById('itens-wrap');
            const addBtn = document.getElementById('add-item');
            const tpl = document.getElementById('item-template');
            let nextIndex = {{ count($content['itens']) }};

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
