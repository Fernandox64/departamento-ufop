@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">Pessoal</h1>

    <form method="POST" action="{{ route('admin.pessoal.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <label class="form-label">Titulo da pagina</label>
                <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $content['titulo']) }}" required>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <div class="form-check">
                    <input type="checkbox" name="mostrar_menu" value="1" class="form-check-input" id="mostrar_menu" @checked(old('mostrar_menu', $content['mostrar_menu']))>
                    <label class="form-check-label" for="mostrar_menu">Mostrar "Pessoal" no menu principal</label>
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label">Texto de introducao</label>
                <textarea name="introducao" class="form-control" rows="2">{{ old('introducao', $content['introducao']) }}</textarea>
            </div>
        </div>

        <p class="text-muted small">
            O menu "Pessoal" no site exibe um submenu com "Docentes" e "Funcionarios", cada um
            mostrando so as pessoas da categoria correspondente cadastradas abaixo.
        </p>

        <h2 class="h6 mb-3">Pessoas cadastradas</h2>

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
                        <div class="col-md-2">
                            <label class="form-label">Categoria</label>
                            <select name="membros[{{ $i }}][categoria]" class="form-select">
                                <option value="docente" @selected(($membro['categoria'] ?? 'docente') === 'docente')>Docente</option>
                                <option value="funcionario" @selected(($membro['categoria'] ?? '') === 'funcionario')>Funcionario</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label">Foto</label>
                            <input type="file" name="membros[{{ $i }}][foto_arquivo]" class="form-control form-control-sm" accept="image/*">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-outline-danger w-100 remove-row">X</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-membro" class="btn btn-outline-secondary btn-sm mb-4">+ Adicionar pessoa</button>

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
                    <div class="col-md-2">
                        <label class="form-label">Categoria</label>
                        <select name="membros[__INDEX__][categoria]" class="form-select">
                            <option value="docente">Docente</option>
                            <option value="funcionario">Funcionario</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">Foto</label>
                        <input type="file" name="membros[__INDEX__][foto_arquivo]" class="form-control form-control-sm" accept="image/*">
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
            // (evita colidir com o indice de outra pessoa e apagar a foto dela).
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
