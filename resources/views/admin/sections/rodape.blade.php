@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">Rodape do site</h1>
    <p class="text-muted">Tudo o que aparece no rodape (parte de baixo) de todas as paginas do site.</p>

    <form method="POST" action="{{ route('admin.rodape.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Imagem do canto inferior esquerdo</label>
                <div class="mb-2 p-2 bg-dark d-inline-block"><img src="{{ asset($content['logo']) }}" alt="Logo atual" style="max-height:80px;"></div>
                <input type="file" name="logo_arquivo" class="form-control" accept="image/*">
                <small class="text-muted">O fundo do rodape e escuro, entao prefira uma imagem que fique legivel sobre fundo escuro.</small>
            </div>

            <div class="col-12">
                <label class="form-label">Texto abaixo da imagem</label>
                <textarea name="texto" class="form-control" rows="2">{{ old('texto', $content['texto']) }}</textarea>
            </div>

            <div class="col-12"><hr></div>
            <h2 class="h6">Contato exibido no rodape</h2>

            <div class="col-12">
                <label class="form-label">Endereco</label>
                <input type="text" name="endereco" class="form-control" value="{{ old('endereco', $content['endereco']) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Telefone</label>
                <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $content['telefone']) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $content['email']) }}">
            </div>

            <div class="col-12"><hr></div>

            <div class="col-12">
                <label class="form-label">Texto de direitos autorais (aparece apos "&copy; {{ date('Y') }} {{ $siteSettings['nome_site'] }}.")</label>
                <input type="text" name="copyright" class="form-control" value="{{ old('copyright', $content['copyright']) }}">
            </div>
        </div>

        <p class="text-muted mt-3">As redes sociais que aparecem no rodape sao as mesmas configuradas em <a href="{{ route('admin.configuracoes.edit') }}">Configuracoes gerais</a>.</p>

        <button type="submit" class="btn btn-primary mt-2">Salvar alteracoes</button>
    </form>
@endsection
