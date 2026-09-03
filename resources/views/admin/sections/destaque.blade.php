@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">Imagem de destaque</h1>

    <p class="text-muted">
        E a imagem grande que abre a pagina inicial, ao lado das ultimas noticias. Ela fica
        fixa: nao muda quando uma noticia nova e publicada — troque aqui quando quiser.
        A imagem e exibida sempre em formato quadrado, recortada pelo centro, independente do
        tamanho do arquivo enviado.
    </p>

    <form method="POST" action="{{ route('admin.destaque.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
            <div class="col-md-5">
                <label class="form-label">Imagem atual</label>
                @if(!empty($content['imagem']))
                    <div class="mb-2">
                        <img src="{{ asset($content['imagem']) }}" alt="Imagem de destaque"
                             class="rounded" style="width:100%;max-width:260px;aspect-ratio:1/1;object-fit:cover;">
                    </div>
                @else
                    <p class="text-muted small">Nenhuma imagem enviada ainda.</p>
                @endif
                <label class="form-label">Trocar imagem</label>
                <input type="file" name="imagem_arquivo" class="form-control" accept="image/*">
                <small class="text-muted">Deixe em branco para manter a imagem atual.</small>
            </div>

            <div class="col-md-7">
                <div class="mb-3">
                    <label class="form-label">Legenda (opcional)</label>
                    <input type="text" name="legenda" class="form-control"
                           value="{{ old('legenda', $content['legenda']) }}"
                           placeholder="Texto exibido sobre a imagem">
                    <small class="text-muted">Aparece sobre a imagem. Deixe em branco para nao exibir texto.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Link (opcional)</label>
                    <input type="text" name="link" class="form-control"
                           value="{{ old('link', $content['link']) }}" placeholder="https://...">
                    <small class="text-muted">Se preenchido, clicar na imagem leva para este endereco.</small>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Salvar alteracoes</button>
        </div>
    </form>
@endsection
