@extends('layouts.app')

@section('title', 'Noticias e Editais')

@section('breadcrumb')
    @include('partials.breadcrumb', ['titulo' => 'Noticias e Editais'])
@endsection

@section('content')
    <div class="py-5">
        <div class="container">
            {{-- Mantem o ano escolhido ao trocar de tipo; se aquele ano nao tiver
                 publicacoes do novo tipo, o controller cai no mais recente. --}}
            <div class="d-flex gap-2 mb-3 flex-wrap">
                <a href="{{ route('noticias.index', array_filter(['ano' => $anoSelecionado])) }}" class="btn btn-sm {{ !$tipo ? 'btn-primary' : 'btn-outline-secondary' }}">Todas</a>
                <a href="{{ route('noticias.index', array_filter(['tipo' => 'noticia', 'ano' => $anoSelecionado])) }}" class="btn btn-sm {{ $tipo === 'noticia' ? 'btn-primary' : 'btn-outline-secondary' }}">Noticias</a>
                <a href="{{ route('noticias.index', array_filter(['tipo' => 'edital', 'ano' => $anoSelecionado])) }}" class="btn btn-sm {{ $tipo === 'edital' ? 'btn-primary' : 'btn-outline-secondary' }}">Editais</a>
            </div>

            @if(count($anos) > 1)
                <div class="d-flex gap-2 mb-4 flex-wrap align-items-center noticias-anos">
                    <span class="text-muted small me-1">Ano:</span>
                    @foreach($anos as $ano)
                        <a href="{{ route('noticias.index', array_filter(['tipo' => $tipo, 'ano' => $ano])) }}"
                           class="btn btn-sm {{ $ano === $anoSelecionado ? 'btn-primary' : 'btn-outline-secondary' }}">{{ $ano }}</a>
                    @endforeach
                </div>
            @endif

            @if(empty($items))
                <p class="text-muted">Nenhuma publicacao encontrada.</p>
            @else
                <div class="row g-4">
                    @foreach($items as $item)
                        <div class="col-md-4">
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
                                    <p class="small text-muted mb-0">{{ \Illuminate\Support\Str::limit($item['resumo'], 110) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <p class="text-muted small mt-4 mb-0">
                    {{ count($items) }} {{ count($items) === 1 ? 'publicacao' : 'publicacoes' }} em {{ $anoSelecionado }}.
                </p>
            @endif
        </div>
    </div>
@endsection
