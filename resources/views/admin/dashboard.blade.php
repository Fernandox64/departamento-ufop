@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">Bem-vindo(a)!</h1>
    <p class="text-muted">Escolha abaixo a secao do site que deseja editar. As alteracoes aparecem no site assim que forem salvas.</p>

    <div class="row g-3 mt-2">
        @foreach($secoes as $secao)
            <div class="col-md-4">
                <a href="{{ route($secao['rota']) }}" class="dash-tile">
                    <span class="dash-tile-icon"><i class="{{ $secao['icone'] ?? 'fa-solid fa-file-lines' }}"></i></span>
                    <span class="dash-tile-body">
                        <span class="dash-tile-title">{{ $secao['titulo'] }}</span>
                        <span class="dash-tile-action">
                            {{ $secao['acao'] ?? 'Editar' }}
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>
                    </span>
                </a>
            </div>
        @endforeach
    </div>
@endsection

@push('styles')
    <style>
        .dash-tile {
            display: flex;
            align-items: center;
            gap: .9rem;
            height: 100%;
            padding: 1rem 1.1rem;
            border: 1px solid #e3e7ec;
            border-radius: .65rem;
            background: #fff;
            text-decoration: none;
            color: inherit;
            transition: border-color .15s ease, box-shadow .15s ease, transform .15s ease;
        }
        .dash-tile:hover,
        .dash-tile:focus-visible {
            border-color: var(--brand-wine);
            box-shadow: 0 6px 16px -8px rgba(var(--brand-wine-rgb), .45);
            transform: translateY(-1px);
            color: inherit;
        }
        .dash-tile-icon {
            flex: 0 0 auto;
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(var(--brand-wine-rgb), .08);
            color: var(--brand-wine);
            font-size: 1.05rem;
        }
        .dash-tile-body {
            display: flex;
            flex-direction: column;
            gap: .3rem;
            min-width: 0;
        }
        .dash-tile-title {
            font-weight: 600;
            font-size: .95rem;
            line-height: 1.3;
            color: #1c222b;
        }
        .dash-tile-action {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            font-size: .76rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: var(--brand-wine);
        }
        .dash-tile-action i {
            font-size: .68rem;
            transition: transform .15s ease;
        }
        .dash-tile:hover .dash-tile-action i {
            transform: translateX(3px);
        }
    </style>
@endpush
