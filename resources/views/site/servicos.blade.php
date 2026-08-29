@extends('layouts.app')

@section('title', $content['titulo'])

@section('breadcrumb')
    @include('partials.breadcrumb', ['titulo' => $content['titulo']])
@endsection

@section('content')
    <div class="py-5">
        <div class="container">
            @if($content['introducao'])
                <p class="lead text-center col-lg-8 mx-auto">{{ $content['introducao'] }}</p>
            @endif
            <div class="row g-4 mt-2">
                @foreach($content['itens'] as $item)
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
    </div>
@endsection
