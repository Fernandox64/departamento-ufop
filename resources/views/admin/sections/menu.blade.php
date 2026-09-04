@extends('admin.layout')

@section('content')
    @php
        $abas = [
            'inicio' => 'Inicio',
            'departamento' => 'O Departamento',
            'graduacao' => 'Graduacao',
            'pos_graduacao' => 'Pos-Graduacao',
            'servicos' => 'Servicos',
            'noticias' => 'Noticias',
            'eventos' => 'Eventos',
            'pessoal' => 'Pessoal',
            'contato' => 'Contato',
        ];
    @endphp

    <h1 class="h4 mb-4">Menu principal</h1>

    <form method="POST" action="{{ route('admin.menu.update') }}">
        @csrf

        <div class="row g-3">
            @foreach($abas as $chave => $rotulo)
                <div class="col-md-4">
                    <div class="border rounded-3 p-3 h-100">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="{{ $chave }}" value="1" class="form-check-input" id="menu_{{ $chave }}" @checked(old($chave, $content[$chave] ?? true))>
                            <label class="form-check-label fw-semibold" for="menu_{{ $chave }}">{{ $rotulo }}</label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Salvar menu</button>
        </div>
    </form>
@endsection
