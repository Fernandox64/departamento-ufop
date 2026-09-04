@php
    $menuTransparente = !empty($siteThemeOptions['menu_transparente']);
    $logoCabecalho = $menuTransparente
        ? ($siteSettings['logo_transparente'] ?? $siteSettings['logo'])
        : $siteSettings['logo'];
@endphp

<header id="back-header" class="back-header {{ $menuTransparente ? 'main-header-transparent' : '' }}">
    <nav class="main-header-bar navbar navbar-expand-lg navbar-dark">
        <div class="container flex-wrap gap-3 py-2">
            <a href="{{ route('home') }}" class="main-header-brand d-flex align-items-center gap-3 text-decoration-none me-lg-4">
                <span class="main-header-logo-box">
                    <img src="{{ asset($logoCabecalho) }}" alt="{{ $siteSettings['nome_site'] }}">
                </span>
                <span class="main-header-title">{{ $siteSettings['nome_site'] }}</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavCollapse" aria-controls="mainNavCollapse" aria-expanded="false" aria-label="Abrir menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavCollapse">
                <ul class="navbar-nav">
                    @if($menuPrincipal['inicio'] ?? true)
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                    @endif
                    @if($menuPrincipal['departamento'] ?? true)
                        <li class="nav-item"><a class="nav-link" href="{{ route('sobre') }}">O Departamento</a></li>
                    @endif
                    @if($menuPrincipal['graduacao'] ?? true)
                        <li class="nav-item"><a class="nav-link" href="{{ route('graduacao') }}">Graduacao</a></li>
                    @endif
                    @if($menuPrincipal['pos_graduacao'] ?? true)
                        <li class="nav-item"><a class="nav-link" href="{{ route('pos-graduacao') }}">Pos-Graduacao</a></li>
                    @endif
                    @if($menuPrincipal['servicos'] ?? true)
                        <li class="nav-item"><a class="nav-link" href="{{ route('servicos') }}">Servicos</a></li>
                    @endif
                    @if($menuPrincipal['noticias'] ?? true)
                        <li class="nav-item"><a class="nav-link" href="{{ route('noticias.index') }}">Noticias</a></li>
                    @endif
                    @if($menuPrincipal['eventos'] ?? false)
                        <li class="nav-item"><a class="nav-link" href="{{ route('eventos.index') }}">Eventos</a></li>
                    @endif
                    @if($menuPrincipal['pessoal'] ?? true)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="menuPessoalDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pessoal</a>
                            <ul class="dropdown-menu" aria-labelledby="menuPessoalDropdown">
                                <li><a class="dropdown-item" href="{{ route('pessoal.docentes') }}">Docentes</a></li>
                                <li><a class="dropdown-item" href="{{ route('pessoal.funcionarios') }}">Funcionarios</a></li>
                            </ul>
                        </li>
                    @endif
                    @if($menuPrincipal['contato'] ?? true)
                        <li class="nav-item"><a class="nav-link" href="{{ route('contato') }}">Contato</a></li>
                    @endif
                </ul>

                <ul class="navbar-nav ms-lg-auto align-items-lg-center header-icons">
                    @foreach(['facebook','twitter','instagram','linkedin','youtube'] as $rede)
                        @if(!empty($siteSettings[$rede]))
                            <li class="nav-item"><a class="nav-link" href="{{ $siteSettings[$rede] }}" target="_blank" rel="noopener"><i class="fa-brands fa-{{ $rede }}"></i></a></li>
                        @endif
                    @endforeach
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.login') }}" title="Area administrativa"><i class="fa-solid fa-lock"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
