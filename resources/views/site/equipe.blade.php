@extends('layouts.app')

@section('title', $content['titulo'])

@section('breadcrumb')
    @include('partials.breadcrumb', ['titulo' => $content['titulo']])
@endsection

@section('content')
    <div class="back-team-page py-5">
        <div class="container">
            @if($content['introducao'])
                <p class="lead text-center col-lg-8 mx-auto mb-5">{{ $content['introducao'] }}</p>
            @endif
            <div class="row g-4">
                @foreach($content['membros'] as $membro)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-team">
                            <div class="team-img">
                                <img src="{{ asset($membro['foto']) }}" alt="{{ $membro['nome'] }}">
                            </div>
                            <div class="team-info">
                                <h3 class="name">{{ $membro['nome'] }}</h3>
                                <p class="desgnation">{{ $membro['cargo'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
