@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">Tema e Cores do Site</h1>

    <form method="POST" action="{{ route('admin.tema.update') }}">
        @csrf

        <div class="border rounded bg-white">
            <div class="p-3 border-bottom">
                <h2 class="h6 mb-0">Escolha uma paleta</h2>
            </div>

            <div class="p-3">
                <div class="row g-3">
                    @foreach($paletas as $key => $paleta)
                        @php $selecionada = old('paleta', $content['paleta']) === $key; @endphp
                        <div class="col-xl-4 col-md-6">
                            <label class="tema-card {{ $selecionada ? 'is-selected' : '' }}">
                                <input type="radio" name="paleta" value="{{ $key }}" class="tema-card-radio" {{ $selecionada ? 'checked' : '' }}>
                                <span class="tema-card-header">
                                    <span class="tema-card-title">{{ $paleta['nome'] }}</span>
                                    <span class="tema-radio-visual"></span>
                                </span>
                                <span class="tema-card-desc">{{ $paleta['descricao'] }}</span>
                                <span class="tema-swatches">
                                    @foreach($paleta['cores'] as $cor)
                                        <span class="tema-swatch" style="background: {{ $cor }}"></span>
                                    @endforeach
                                </span>
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="tema-options mt-4">
                    <div>
                        <h2 class="h6 mb-1">Menu principal</h2>
                        <p class="text-muted small mb-0">Controle a aparencia da barra de navegacao do site.</p>
                    </div>
                    <label class="tema-toggle">
                        <input type="checkbox" name="menu_transparente" value="1" {{ old('menu_transparente', $content['menu_transparente'] ?? false) ? 'checked' : '' }}>
                        <span class="tema-toggle-control"></span>
                        <span>
                            <span class="tema-toggle-title">Menu transparente</span>
                            <span class="tema-toggle-status">
                                {{ old('menu_transparente', $content['menu_transparente'] ?? false) ? 'Ativado' : 'Desativado' }}
                            </span>
                        </span>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Aplicar paleta</button>
            </div>
        </div>
    </form>
@endsection

@push('styles')
    <style>
        .tema-card {
            display: block;
            height: 100%;
            margin: 0;
            padding: 14px 12px;
            border: 1px solid #d6dde6;
            border-radius: 8px;
            background: #fff;
            cursor: pointer;
            transition: border-color .15s ease, box-shadow .15s ease;
        }
        .tema-card:hover,
        .tema-card.is-selected,
        .tema-card:has(.tema-card-radio:checked) {
            border-color: #0d6efd;
            box-shadow: 0 0 0 1px #0d6efd;
        }
        .tema-card-radio {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }
        .tema-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 6px;
        }
        .tema-card-title {
            color: #071323;
            font-weight: 700;
            line-height: 1.25;
        }
        .tema-card-desc {
            display: block;
            min-height: 38px;
            color: #465363;
            font-size: .88rem;
            line-height: 1.35;
        }
        .tema-radio-visual {
            flex: 0 0 auto;
            width: 14px;
            height: 14px;
            border: 1px solid #7b8794;
            border-radius: 50%;
            background: #fff;
        }
        .tema-card.is-selected .tema-radio-visual,
        .tema-card:has(.tema-card-radio:checked) .tema-radio-visual {
            border: 4px solid #0d6efd;
        }
        .tema-swatches {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 6px;
            margin-top: 10px;
        }
        .tema-swatch {
            height: 20px;
            border: 1px solid rgba(0, 0, 0, .12);
            border-radius: 5px;
        }
        .tema-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 16px;
            border: 1px solid #d6dde6;
            border-radius: 8px;
            background: #f8fafc;
        }
        .tema-toggle {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin: 0;
            cursor: pointer;
        }
        .tema-toggle input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }
        .tema-toggle-control {
            position: relative;
            width: 46px;
            height: 24px;
            border-radius: 999px;
            background: #9aa2ad;
            transition: background-color .15s ease;
        }
        .tema-toggle-control::after {
            content: "";
            position: absolute;
            top: 3px;
            left: 3px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #fff;
            transition: transform .15s ease;
        }
        .tema-toggle input:checked + .tema-toggle-control {
            background: var(--brand-red-strong);
        }
        .tema-toggle input:checked + .tema-toggle-control::after {
            transform: translateX(22px);
        }
        .tema-toggle-title,
        .tema-toggle-status {
            display: block;
            line-height: 1.25;
        }
        .tema-toggle-title {
            font-weight: 700;
        }
        .tema-toggle-status {
            color: #6b7280;
            font-size: .82rem;
        }
        @media (max-width: 575.98px) {
            .tema-options {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
@endpush
