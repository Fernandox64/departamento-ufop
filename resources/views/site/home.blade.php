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
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row g-4">
                    <div class="{{ $mostrarEventos && !empty($eventos) ? 'col-lg-8' : 'col-12' }}">
                        <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-4">
                            <div class="back-title mb-0"><h2>Ultimas noticias</h2></div>
                            <a href="{{ route('noticias.index') }}" class="back-btn">Ver todas</a>
                        </div>
                        <div class="row g-4">
                            @foreach($noticias as $item)
                                <div class="{{ $mostrarEventos && !empty($eventos) ? 'col-md-6' : 'col-md-4' }}">
                                    <div class="noticia-card h-100">
                                        <a href="{{ route('noticias.show', $item['id']) }}" class="noticia-card-img">
                                            @if(!empty($item['imagem']))
                                                <img src="{{ asset($item['imagem']) }}" alt="{{ $item['titulo'] }}">
                                            @else
                                                <span class="noticia-card-img-placeholder"><i class="fa-solid fa-newspaper"></i></span>
                                            @endif
                                        </a>
                                        <div class="p-3">
                                            <span class="badge noticia-badge-{{ $item['tipo'] }}">{{ $item['tipo'] === 'edital' ? 'Edital' : 'Noticia' }}</span>
                                            <span class="text-muted small ms-2">{{ \Illuminate\Support\Carbon::parse($item['data_publicacao'])->format('d/m/Y') }}</span>
                                            <h3 class="h6 mt-2"><a href="{{ route('noticias.show', $item['id']) }}" class="text-decoration-none text-reset">{{ $item['titulo'] }}</a></h3>
                                            <p class="small text-muted mb-0">{{ \Illuminate\Support\Str::limit($item['resumo'], 90) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if($mostrarEventos && !empty($eventos))
                        <div class="col-lg-4">
                            <div class="eventos-sidebar h-100">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h2 class="h5 mb-0">Eventos</h2>
                                    <a href="{{ route('eventos.index') }}" class="small">Ver todos</a>
                                </div>
                                <div class="d-flex flex-column gap-3">
                                    @foreach($eventos as $evento)
                                        <div class="d-flex gap-3 align-items-start">
                                            <div class="evento-data-badge text-center flex-shrink-0">
                                                <div class="evento-data-dia">{{ \Illuminate\Support\Carbon::parse($evento['data_evento'])->format('d') }}</div>
                                                <div class="evento-data-mes">{{ \Illuminate\Support\Carbon::parse($evento['data_evento'])->translatedFormat('M') }}</div>
                                            </div>
                                            <div>
                                                <h3 class="h6 mb-0">{{ $evento['titulo'] }}</h3>
                                                @if(!empty($evento['local']))
                                                    <p class="small text-muted mb-0">{{ $evento['local'] }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
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
