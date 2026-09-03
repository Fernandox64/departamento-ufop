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
    </style>
</head>
<body>
    <nav class="navbar navbar-dark admin-topbar mb-4">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Painel administrativo - {{ $siteSettings['nome_site'] }}</span>
            <div class="d-flex align-items-center gap-2">
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
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Painel</a>
                @if(session('admin_nivel') === 'administrador')
                    <a href="{{ route('admin.configuracoes.edit') }}" class="{{ request()->routeIs('admin.configuracoes.*') ? 'active' : '' }}">Configuracoes gerais</a>
                    <a href="{{ route('admin.logos.edit') }}" class="{{ request()->routeIs('admin.logos.*') ? 'active' : '' }}">Logos do site</a>
                @endif
                <a href="{{ route('admin.tema.edit') }}" class="{{ request()->routeIs('admin.tema.*') ? 'active' : '' }}">Tema e Cores</a>
                <a href="{{ route('admin.rodape.edit') }}" class="{{ request()->routeIs('admin.rodape.*') ? 'active' : '' }}">Rodape do site</a>
                <a href="{{ route('admin.home.edit') }}" class="{{ request()->routeIs('admin.home.*') ? 'active' : '' }}">Pagina inicial</a>
                <a href="{{ route('admin.destaque.edit') }}" class="{{ request()->routeIs('admin.destaque.*') ? 'active' : '' }}">Imagens de destaque</a>
                <a href="{{ route('admin.carrossel.edit') }}" class="{{ request()->routeIs('admin.carrossel.*') ? 'active' : '' }}">Carrossel de imagens</a>
                <a href="{{ route('admin.noticias.index') }}" class="{{ request()->routeIs('admin.noticias.*') ? 'active' : '' }}">Noticias e Editais</a>
                <a href="{{ route('admin.eventos.index') }}" class="{{ request()->routeIs('admin.eventos.*') ? 'active' : '' }}">Eventos</a>
                <a href="{{ route('admin.sobre.edit') }}" class="{{ request()->routeIs('admin.sobre.*') ? 'active' : '' }}">Sobre o departamento</a>
                <a href="{{ route('admin.servicos.edit') }}" class="{{ request()->routeIs('admin.servicos.*') ? 'active' : '' }}">Servicos</a>
                <a href="{{ route('admin.graduacao.edit') }}" class="{{ request()->routeIs('admin.graduacao.*') ? 'active' : '' }}">Graduacao</a>
                <a href="{{ route('admin.pos-graduacao.edit') }}" class="{{ request()->routeIs('admin.pos-graduacao.*') ? 'active' : '' }}">Pos-Graduacao</a>
                <a href="{{ route('admin.pessoal.edit') }}" class="{{ request()->routeIs('admin.pessoal.*') ? 'active' : '' }}">Pessoal</a>
                <a href="{{ route('admin.contato.edit') }}" class="{{ request()->routeIs('admin.contato.*') ? 'active' : '' }}">Contato</a>
                @if(session('admin_nivel') === 'administrador')
                    <hr>
                    <a href="{{ route('admin.backup.index') }}" class="{{ request()->routeIs('admin.backup.*') ? 'active' : '' }}">Backup do site</a>
                    <a href="{{ route('admin.membros.index') }}" class="{{ request()->routeIs('admin.membros.*') ? 'active' : '' }}">Membros da equipe</a>
                @endif
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
