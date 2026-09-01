@extends('layouts.app')

@section('content')
    @if(!empty($carrossel['slides']))
        <section class="dept-carousel-section">
            <div class="dept-carousel owl-carousel">
                @foreach($carrossel['slides'] as $slide)
                    <div class="dept-carousel-slide">
                        <img src="{{ asset($slide['imagem']) }}" alt="{{ $slide['legenda'] ?? $siteSettings['nome_site'] }}">
                        @if(!empty($slide['legenda']))
                            <div class="dept-carousel-caption">{{ $slide['legenda'] }}</div>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if(!empty($noticias))
        @php
            // 1a noticia vira o destaque grande; as demais (ate 4) ficam na lista ao lado.
            $noticiaDestaque = $noticias[0];
            $noticiasLista = array_slice($noticias, 1, 4);
        @endphp
        <section class="back-hero-area back-latest-posts">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="back-title mb-0"><h2>Ultimas noticias</h2></div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <a href="{{ route('noticias.index') }}" class="back-btn">Ver todas</a>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-8">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <div class="image-area dept-destaque @if(empty($noticiaDestaque['imagem'])) dept-destaque-sem-imagem @endif">
                                    <a href="{{ route('noticias.show', $noticiaDestaque['id']) }}">
                                        @if(!empty($noticiaDestaque['imagem']))
                                            <img src="{{ asset($noticiaDestaque['imagem']) }}" alt="{{ $noticiaDestaque['titulo'] }}">
                                        @endif
                                    </a>
                                    <div class="back-btm-content">
                                        <span class="back-cate dept-cate-{{ $noticiaDestaque['tipo'] }}">{{ $noticiaDestaque['tipo'] === 'edital' ? 'Edital' : 'Noticia' }}</span>
                                        <h3><a href="{{ route('noticias.show', $noticiaDestaque['id']) }}">{{ $noticiaDestaque['titulo'] }}</a></h3>
                                        <ul class="list-unstyled mb-0">
                                            <li class="back-date">
                                                <i class="fa-solid fa-clock me-2"></i>
                                                {{ \Illuminate\Support\Carbon::parse($noticiaDestaque['data_publicacao'])->translatedFormat('d \d\e F \d\e Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-4 md-mt-40">
                        <ul class="back-hero-bottom list-unstyled">
                            @foreach($noticiasLista as $item)
                                <li>
                                    <div class="image-areas">
                                        <a href="{{ route('noticias.show', $item['id']) }}">
                                            @if(!empty($item['imagem']))
                                                <img src="{{ asset($item['imagem']) }}" alt="{{ $item['titulo'] }}">
                                            @else
                                                <span class="dept-thumb-vazia dept-cate-{{ $item['tipo'] }}">
                                                    <i class="fa-solid {{ $item['tipo'] === 'edital' ? 'fa-file-lines' : 'fa-newspaper' }}"></i>
                                                </span>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="back-btm-content">
                                        <span class="back-cates">{{ $item['tipo'] === 'edital' ? 'Edital' : 'Noticia' }}</span>
                                        <h3><a href="{{ route('noticias.show', $item['id']) }}">{{ $item['titulo'] }}</a></h3>
                                        <ul class="list-unstyled mb-0">
                                            <li class="back-date">
                                                <i class="fa-solid fa-clock me-2"></i>
                                                {{ \Illuminate\Support\Carbon::parse($item['data_publicacao'])->format('d/m/Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if($mostrarEventos && !empty($eventos))
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row align-items-center mb-4">
                    <div class="col-md-8">
                        <div class="back-title mb-0"><h2>Proximos eventos</h2></div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <a href="{{ route('eventos.index') }}" class="back-btn">Ver todos</a>
                    </div>
                </div>
                <div class="row g-4">
                    @foreach($eventos as $evento)
                        <div class="col-lg-4 col-md-6">
                            <div class="d-flex gap-3 align-items-start bg-white p-3 rounded-3 h-100 border">
                                <div class="evento-data-badge text-center flex-shrink-0">
                                    <div class="evento-data-dia">{{ \Illuminate\Support\Carbon::parse($evento['data_evento'])->format('d') }}</div>
                                    <div class="evento-data-mes">{{ \Illuminate\Support\Carbon::parse($evento['data_evento'])->translatedFormat('M') }}</div>
                                </div>
                                <div>
                                    <h3 class="h6 mb-1">{{ $evento['titulo'] }}</h3>
                                    @if(!empty($evento['local']))
                                        <p class="small text-muted mb-0">{{ $evento['local'] }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="dept-hero text-white text-center py-5">
        <div class="container py-4">
            <h1 class="display-5 fw-bold">{{ $content['hero_titulo'] }}</h1>
            <p class="lead col-lg-8 mx-auto">{{ $content['hero_subtitulo'] }}</p>
            <div class="mt-4 d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('sobre') }}" class="dept-hero-btn">Conheca o Departamento</a>
                <a href="{{ route('contato') }}" class="dept-hero-btn">Fale Conosco</a>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                @foreach($content['destaques'] as $item)
                    <div class="col-md-4">
                        <div class="text-center p-4 h-100 border rounded-3">
                            <i class="{{ $item['icone'] }} fa-2x mb-3 text-primary"></i>
                            <h3 class="h5">{{ $item['titulo'] }}</h3>
                            <p class="mb-0">{{ $item['texto'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="back-hero-area back-latest-posts back-whats-posts py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <img src="{{ asset('assets/images/about.png') }}" class="img-fluid rounded" alt="{{ $siteSettings['nome_site'] }}">
                </div>
                <div class="col-lg-6">
                    <div class="back-title"><h2>{{ $content['sobre_titulo'] }}</h2></div>
                    <p>{{ $content['sobre_texto'] }}</p>
                    <a href="{{ route('sobre') }}" class="back-btn">Saiba mais</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@if(!empty($carrossel['slides']))
    @push('scripts')
        <script>
            $(function () {
                $('.dept-carousel').owlCarousel({
                    items: 1,
                    loop: {{ count($carrossel['slides']) > 1 ? 'true' : 'false' }},
                    autoplay: {{ count($carrossel['slides']) > 1 ? 'true' : 'false' }},
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    nav: {{ count($carrossel['slides']) > 1 ? 'true' : 'false' }},
                    dots: {{ count($carrossel['slides']) > 1 ? 'true' : 'false' }},
                    margin: 0,
                    navText: ['<i class="fa-solid fa-chevron-left"></i>', '<i class="fa-solid fa-chevron-right"></i>']
                });
            });
        </script>
    @endpush
@endif
