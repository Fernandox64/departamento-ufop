@extends('layouts.app')

@section('title', 'Noticias e Editais')

@section('breadcrumb')
    @include('partials.breadcrumb', ['titulo' => 'Noticias e Editais'])
@endsection

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="d-flex gap-2 mb-4 flex-wrap">
                <a href="{{ route('noticias.index') }}" class="btn btn-sm {{ !$tipo ? 'btn-primary' : 'btn-outline-secondary' }}">Todas</a>
                <a href="{{ route('noticias.index', ['tipo' => 'noticia']) }}" class="btn btn-sm {{ $tipo === 'noticia' ? 'btn-primary' : 'btn-outline-secondary' }}">Noticias</a>
                <a href="{{ route('noticias.index', ['tipo' => 'edital']) }}" class="btn btn-sm {{ $tipo === 'edital' ? 'btn-primary' : 'btn-outline-secondary' }}">Editais</a>
            </div>

            @if($items->isEmpty())
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

                <div class="mt-4">
                    {{ $items->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection
