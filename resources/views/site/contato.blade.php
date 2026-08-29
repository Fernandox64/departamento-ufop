@extends('layouts.app')

@section('title', $content['titulo'])

@section('breadcrumb')
    @include('partials.breadcrumb', ['titulo' => $content['titulo']])
@endsection

@section('content')
    <div class="back-contact-page pt-70 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <p class="lead">{{ $content['texto_intro'] }}</p>
                </div>
            </div>
            <div class="row g-4 justify-content-center text-center">
                @if($content['endereco'])
                    <div class="col-md-4">
                        <i class="fa-solid fa-location-dot fa-2x mb-2 text-primary"></i>
                        <h3 class="h6">Endereco</h3>
                        <p>{{ $content['endereco'] }}</p>
                    </div>
                @endif
                @if($content['telefone_1'] || $content['telefone_2'])
                    <div class="col-md-4">
                        <i class="fa-solid fa-phone fa-2x mb-2 text-primary"></i>
                        <h3 class="h6">Telefone</h3>
                        @if($content['telefone_1'])<p class="mb-0">{{ $content['telefone_1'] }}</p>@endif
                        @if($content['telefone_2'])<p>{{ $content['telefone_2'] }}</p>@endif
                    </div>
                @endif
                @if($content['email_1'] || $content['email_2'])
                    <div class="col-md-4">
                        <i class="fa-solid fa-envelope fa-2x mb-2 text-primary"></i>
                        <h3 class="h6">E-mail</h3>
                        @if($content['email_1'])<p class="mb-0"><a href="mailto:{{ $content['email_1'] }}">{{ $content['email_1'] }}</a></p>@endif
                        @if($content['email_2'])<p><a href="mailto:{{ $content['email_2'] }}">{{ $content['email_2'] }}</a></p>@endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($content['mapa_embed_url'])
        <div class="back-contacts">
            <div class="back-image-maping">
                <iframe src="{{ $content['mapa_embed_url'] }}" width="100%" height="450" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    @endif
@endsection
