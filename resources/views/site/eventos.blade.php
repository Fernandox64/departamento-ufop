@extends('layouts.app')

@section('title', 'Eventos')

@section('breadcrumb')
    @include('partials.breadcrumb', ['titulo' => 'Eventos'])
@endsection

@section('content')
    <div class="py-5">
        <div class="container">
            @if(empty($items))
                <p class="text-muted text-center">Nenhum evento cadastrado no momento.</p>
            @else
                <div class="row g-4 justify-content-center">
                    @foreach($items as $item)
                        <div class="col-md-8">
                            <div class="d-flex gap-3 p-3 border rounded-3">
                                <div class="evento-data-badge text-center flex-shrink-0">
                                    <div class="evento-data-dia">{{ \Illuminate\Support\Carbon::parse($item['data_evento'])->format('d') }}</div>
                                    <div class="evento-data-mes">{{ \Illuminate\Support\Carbon::parse($item['data_evento'])->translatedFormat('M') }}</div>
                                </div>
                                <div>
                                    <h3 class="h6 mb-1">{{ $item['titulo'] }}</h3>
                                    @if(!empty($item['local']))
                                        <p class="small text-muted mb-1"><i class="fa-solid fa-location-dot"></i> {{ $item['local'] }}</p>
                                    @endif
                                    @if(!empty($item['descricao']))
                                        <p class="small mb-2">{{ $item['descricao'] }}</p>
                                    @endif
                                    @if(!empty($item['link']))
                                        <a href="{{ $item['link'] }}" target="_blank" rel="noopener" class="small">Mais informacoes</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
