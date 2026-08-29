@extends('layouts.app')

@section('title', $content['titulo'])

@section('breadcrumb')
    @include('partials.breadcrumb', ['titulo' => $content['titulo']])
@endsection

@section('content')
    <div class="py-5">
        <div class="container">
            @if($content['texto_intro'])
                <p class="lead text-center col-lg-8 mx-auto mb-5">{{ $content['texto_intro'] }}</p>
            @endif

            @if(empty($content['cursos']))
                <p class="text-muted text-center">Nenhum curso cadastrado ainda.</p>
            @else
                <div class="row g-4 justify-content-center">
                    @foreach($content['cursos'] as $curso)
                        <div class="col-md-5">
                            <div class="text-center p-4 h-100 border rounded-3">
                                <i class="fa-solid fa-graduation-cap fa-2x mb-3 text-primary"></i>
                                <h3 class="h6 mb-3">{{ $curso['nome'] }}</h3>
                                @if(!empty($curso['link']))
                                    <a href="{{ $curso['link'] }}" target="_blank" rel="noopener" class="back-btn">Saiba mais</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
