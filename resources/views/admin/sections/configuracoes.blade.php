@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">Configuracoes gerais</h1>
    <p class="text-muted">Identidade do site. Endereco, telefone, e-mail e o logo do rodape ficam em <a href="{{ route('admin.rodape.edit') }}">Rodape do site</a>.</p>

    <form method="POST" action="{{ route('admin.configuracoes.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Nome do site / departamento</label>
                <input type="text" name="nome_site" class="form-control" value="{{ old('nome_site', $content['nome_site']) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Sigla</label>
                <input type="text" name="sigla" class="form-control" value="{{ old('sigla', $content['sigla']) }}">
            </div>

            <div class="col-12"><hr></div>

            <div class="col-md-6">
                <label class="form-label">Logo do site (aparece no cabecalho)</label>
                <div class="mb-2 p-2 bg-dark d-inline-block"><img src="{{ asset($content['logo']) }}" alt="Logo atual" style="max-height:60px;"></div>
                <input type="file" name="logo_arquivo" class="form-control" accept="image/*">
            </div>

            <div class="col-12"><hr></div>
            <h2 class="h6">Redes sociais (deixe em branco para ocultar o icone)</h2>

            <div class="col-md-6">
                <label class="form-label">Facebook</label>
                <input type="text" name="facebook" class="form-control" value="{{ old('facebook', $content['facebook']) }}" placeholder="https://facebook.com/...">
            </div>
            <div class="col-md-6">
                <label class="form-label">Instagram</label>
                <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $content['instagram']) }}" placeholder="https://instagram.com/...">
            </div>
            <div class="col-md-6">
                <label class="form-label">Twitter / X</label>
                <input type="text" name="twitter" class="form-control" value="{{ old('twitter', $content['twitter']) }}" placeholder="https://x.com/...">
            </div>
            <div class="col-md-6">
                <label class="form-label">LinkedIn</label>
                <input type="text" name="linkedin" class="form-control" value="{{ old('linkedin', $content['linkedin']) }}" placeholder="https://linkedin.com/...">
            </div>
            <div class="col-md-6">
                <label class="form-label">YouTube</label>
                <input type="text" name="youtube" class="form-control" value="{{ old('youtube', $content['youtube']) }}" placeholder="https://youtube.com/...">
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Salvar alteracoes</button>
    </form>
@endsection
