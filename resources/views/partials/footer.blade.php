<footer id="back-footer" class="back-footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 md-mb-30">
                    <div class="footer-widget footer-widget-1">
                        <div class="footer-logo white">
                            <a href="{{ route('home') }}" class="logo-text"><img src="{{ asset($rodape['logo']) }}" alt="{{ $siteSettings['nome_site'] }}"></a>
                        </div>
                        <h5 class="footer-subtitle">{{ $rodape['texto'] }}</h5>
                        <h6 class="back-follow-us">Siga-nos</h6>
                        <ul class="social-links">
                            @foreach(['facebook','twitter','instagram','linkedin','youtube'] as $rede)
                                @if(!empty($siteSettings[$rede]))
                                    <li><a href="{{ $siteSettings[$rede] }}" target="_blank" rel="noopener"><i class="fa-brands fa-{{ $rede }}"></i></a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 md-mb-30">
                    <div class="footer-widget footer-widget-2">
                        <h3 class="footer-title">Links rapidos</h3>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="{{ route('home') }}">Inicio</a></li>
                                <li><a href="{{ route('sobre') }}">O Departamento</a></li>
                                <li><a href="{{ route('servicos') }}">Servicos</a></li>
                                <li><a href="{{ route('equipe') }}">Equipe</a></li>
                                <li><a href="{{ route('contato') }}">Contato</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-widget footer-widget-2">
                        <h3 class="footer-title">Contato</h3>
                        <div class="footer-menu">
                            <ul>
                                @if($rodape['endereco'])<li>{{ $rodape['endereco'] }}</li>@endif
                                @if($rodape['telefone'])<li>{{ $rodape['telefone'] }}</li>@endif
                                @if($rodape['email'])<li><a href="mailto:{{ $rodape['email'] }}">{{ $rodape['email'] }}</a></li>@endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container">
            <div class="back-copy-left">&copy; {{ date('Y') }} {{ $siteSettings['nome_site'] }}. {{ $rodape['copyright'] }}</div>
        </div>
    </div>
</footer>
