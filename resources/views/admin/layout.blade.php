<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Painel administrativo | {{ $siteSettings['nome_site'] }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/brand.css') }}?v={{ \App\Support\Assets::versao('assets/css/brand.css') }}">
    @include('partials.theme-vars')
    @stack('styles')
    <style>
        body { background: #f4f5f7; }
        .admin-sidebar a { display: block; padding: .6rem 1rem; border-radius: .4rem; color: #333; text-decoration: none; }
        .admin-sidebar a:hover { background: #e9ecef; }
        .repeat-row { border: 1px solid #dee2e6; border-radius: .5rem; padding: 1rem; margin-bottom: 1rem; background: #fff; }
        .admin-card { background: #fff; border-radius: .5rem; padding: 1.5rem; }

        .admin-nav-toggle { display: none; }
        .admin-sidebar .admin-nav-item { display: flex; align-items: center; gap: .65rem; }
        .admin-sidebar .admin-nav-icon { flex: 0 0 auto; width: 22px; text-align: center; color: #9aa2ad; }
        .admin-sidebar .admin-nav-item:hover .admin-nav-icon,
        .admin-sidebar .admin-nav-item.active .admin-nav-icon { color: var(--brand-red-strong); }
        .admin-sidebar hr { border-color: #dee2e6; margin: .5rem 0; }

        @media (max-width: 991.98px) {
            .admin-nav-toggle { display: inline-flex; }
            #adminSidebarNav.show,
            #adminSidebarNav.collapsing {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(74px, 1fr));
                gap: .5rem;
                background: #fff;
                border-radius: .5rem;
                padding: .85rem;
            }
            .admin-sidebar .admin-nav-item {
                flex-direction: column;
                justify-content: center;
                text-align: center;
                gap: .35rem;
                padding: .65rem .25rem;
                border-radius: .6rem;
            }
            .admin-sidebar .admin-nav-icon {
                width: 38px;
                height: 38px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto;
                border-radius: 10px;
                background: rgba(var(--brand-wine-rgb), .08);
                color: var(--brand-wine);
                font-size: 1rem;
            }
            .admin-sidebar .admin-nav-item.active .admin-nav-icon {
                background: var(--brand-wine);
                color: #fff;
            }
            .admin-sidebar .admin-nav-label { font-size: .68rem; line-height: 1.15; color: #333; }
            .admin-sidebar hr { grid-column: 1 / -1; width: 100%; margin: .15rem 0; }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark admin-topbar mb-4">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Painel administrativo - {{ $siteSettings['nome_site'] }}</span>
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-outline-light btn-sm admin-nav-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#adminSidebarNav" aria-expanded="false" aria-controls="adminSidebarNav" aria-label="Abrir menu do painel">
                    <i class="fa-solid fa-bars"></i>
                </button>
                @if(session('admin_nome'))
                    <span class="text-white-50 small me-2">
                        {{ session('admin_nome') }}
                        <span class="badge {{ match(session('admin_nivel')) { 'administrador' => 'bg-danger', 'secretaria' => 'bg-secondary', default => 'bg-info' } }}">
                            {{ match(session('admin_nivel')) { 'administrador' => 'Administrador', 'secretaria' => 'Secretaria', default => 'Bolsista' } }}
                        </span>
                    </span>
                @endif
                <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-light btn-sm">Ver site</a>
                <form method="POST" action="{{ route('admin.logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Sair</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 admin-sidebar mb-4">
                <div class="collapse d-lg-block" id="adminSidebarNav">
                    <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="admin-nav-icon"><i class="fa-solid fa-gauge-high"></i></span>
                        <span class="admin-nav-label">Painel</span>
                    </a>
                    @php $administrador = session('admin_nivel') === 'administrador'; @endphp
                    @foreach(\App\Support\AdminNav::secoes() as $item)
                        @continue(!empty($item['apenas_administrador']) && ! $administrador)
                        @if(!empty($item['divisor_antes']))
                            <hr>
                        @endif
                        <a href="{{ route($item['rota']) }}" class="admin-nav-item {{ request()->routeIs($item['padrao']) ? 'active' : '' }}">
                            <span class="admin-nav-icon"><i class="{{ $item['icone'] }}"></i></span>
                            <span class="admin-nav-label">{{ $item['titulo_menu'] ?? $item['titulo'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-10">
                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="admin-card mb-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
