@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">Equipe</h1>

    <form method="POST" action="{{ route('admin.equipe.update') }}" enctype="multipart/form-data">
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

        <h2 class="h6 mb-3">Membros da equipe</h2>

        <div id="membros-wrap">
            @foreach($content['membros'] as $i => $membro)
                <div class="repeat-row">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-2 text-center">
                            <img src="{{ asset($membro['foto']) }}" alt="{{ $membro['nome'] }}" class="rounded mb-1" style="width:70px;height:70px;object-fit:cover;">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nome</label>
                            <input type="text" name="membros[{{ $i }}][nome]" class="form-control" value="{{ $membro['nome'] }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Cargo / funcao</label>
                            <input type="text" name="membros[{{ $i }}][cargo]" class="form-control" value="{{ $membro['cargo'] }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nova foto (opcional)</label>
                            <input type="file" name="membros[{{ $i }}][foto_arquivo]" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-outline-danger w-100 remove-row">X</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-membro" class="btn btn-outline-secondary btn-sm mb-4">+ Adicionar membro</button>

        <template id="membro-template">
            <div class="repeat-row">
                <div class="row g-2 align-items-end">
                    <div class="col-md-2 text-center text-muted small">Sem foto ainda</div>
                    <div class="col-md-3">
                        <label class="form-label">Nome</label>
                        <input type="text" name="membros[__INDEX__][nome]" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Cargo / funcao</label>
                        <input type="text" name="membros[__INDEX__][cargo]" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Foto</label>
                        <input type="file" name="membros[__INDEX__][foto_arquivo]" class="form-control" accept="image/*">
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
            const wrap = document.getElementById('membros-wrap');
            const tpl = document.getElementById('membro-template');
            // Contador que so cresce, nunca reaproveita indice de uma linha removida
            // (evita colidir com o indice de outro membro e apagar a foto dele).
            let nextIndex = {{ count($content['membros']) }};

            document.getElementById('add-membro').addEventListener('click', function () {
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
