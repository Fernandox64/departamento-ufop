@extends('layouts.app')

@section('title', $item['titulo'])
@section('description', $item['resumo'])

@section('breadcrumb')
    @include('partials.breadcrumb', ['titulo' => $item['tipo'] === 'edital' ? 'Edital' : 'Noticia'])
@endsection

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <span class="badge noticia-badge-{{ $item['tipo'] }}">{{ $item['tipo'] === 'edital' ? 'Edital' : 'Noticia' }}</span>
                    <span class="text-muted small ms-2">{{ \Illuminate\Support\Carbon::parse($item['data_publicacao'])->format('d/m/Y') }}</span>

                    <h1 class="h3 mt-3">{{ $item['titulo'] }}</h1>
                    <p class="lead">{{ $item['resumo'] }}</p>

                    @if(!empty($item['imagem']))
                        <img src="{{ asset($item['imagem']) }}" alt="{{ $item['titulo'] }}" class="img-fluid rounded mb-4">
                    @endif

                    <div style="white-space: pre-line;">{{ $item['conteudo'] }}</div>

                    @if(!empty($item['anexo']))
                        <div class="mt-4">
                            <a href="{{ asset($item['anexo']) }}" class="back-btn" target="_blank" rel="noopener">
                                <i class="fa-solid fa-paperclip"></i> Baixar anexo
                            </a>
                        </div>
                    @endif

                    <div class="mt-5">
                        <a href="{{ route('noticias.index') }}">&larr; Voltar para noticias e editais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
