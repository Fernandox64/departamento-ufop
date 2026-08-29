@extends('layouts.app')

@section('title', $content['titulo'])

@section('breadcrumb')
    @include('partials.breadcrumb', ['titulo' => $content['titulo']])
@endsection

@section('content')
    <div class="back-hero-area back-latest-posts back-whats-posts py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <img src="{{ asset($content['imagem']) }}" class="img-fluid rounded" alt="{{ $content['titulo'] }}">
                </div>
                <div class="col-lg-6">
                    <div class="back-title"><h2>{{ $content['titulo'] }}</h2></div>
                    <p class="lead">{{ $content['texto_intro'] }}</p>
                    <p style="white-space: pre-line;">{{ $content['texto_corpo'] }}</p>

                    @if(!empty($content['destaques']))
                        <ul class="dot-list">
                            @foreach($content['destaques'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
