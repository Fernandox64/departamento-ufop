@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">Logos do site</h1>
    <p class="text-muted">Edite aqui as imagens usadas no menu principal e no rodape. Cada arquivo deve ter no maximo 2 MB.</p>

    <form method="POST" action="{{ route('admin.logos.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            <div class="col-md-4">
                <label class="form-label">1. Logo menu principal</label>
                <div class="mb-2 p-2 bg-dark d-inline-block">
                    <img src="{{ asset($configuracoes['logo']) }}" alt="Logo menu principal atual" style="max-height:80px;">
                </div>
                <input type="file" name="logo_principal_arquivo" class="form-control" accept="image/*">
                <small class="text-muted">Usada quando o menu principal esta com fundo preto.</small>
            </div>

            <div class="col-md-4">
                <label class="form-label">2. Logo menu principal transparente</label>
                <div class="mb-2 p-2 bg-light border d-inline-block">
                    <img src="{{ asset($configuracoes['logo_transparente'] ?? $configuracoes['logo']) }}" alt="Logo menu transparente atual" style="max-height:80px;">
                </div>
                <input type="file" name="logo_principal_transparente_arquivo" class="form-control" accept="image/*">
                <small class="text-muted">Usada quando a opcao de menu transparente estiver ativada.</small>
            </div>

            <div class="col-md-4">
                <label class="form-label">3. Logo do menu footer</label>
                <div class="mb-2 p-2 bg-dark d-inline-block">
                    <img src="{{ asset($rodape['logo']) }}" alt="Logo do rodape atual" style="max-height:80px;">
                </div>
                <input type="file" name="logo_rodape_arquivo" class="form-control" accept="image/*">
                <small class="text-muted">Usada no rodape do site.</small>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Salvar logos</button>
    </form>
@endsection
