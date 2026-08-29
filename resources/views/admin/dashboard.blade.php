@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">Bem-vindo(a)!</h1>
    <p class="text-muted">Escolha abaixo a secao do site que deseja editar. As alteracoes aparecem no site assim que forem salvas.</p>

    <div class="row g-3 mt-2">
        @foreach($secoes as $secao)
            <div class="col-md-4">
                <div class="border rounded-3 p-3 h-100 d-flex flex-column justify-content-between">
                    <h2 class="h6">{{ $secao['titulo'] }}</h2>
                    <a href="{{ route($secao['rota']) }}" class="btn btn-sm btn-primary mt-2">Editar</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
