@extends('admin.layout')

@section('content')
    <h1 class="h4 mb-4">Backup do site</h1>

    <div class="mb-5">
        <h2 class="h6">Baixar uma copia completa agora</h2>
        <p class="text-muted">
            Gera um arquivo <code>.zip</code> com todo o conteudo editavel do site (textos de todas
            as secoes, noticias/editais, e todas as imagens e anexos enviados) e baixa direto para
            o seu computador.
        </p>
        <p class="text-muted">
            Guarde esse arquivo em um lugar seguro fora do servidor (pendrive, e-mail para voce
            mesmo, nuvem pessoal etc.). Se um dia precisar reverter o site — por exemplo, depois de
            uma invasao — e esse arquivo que voce vai enviar de volta na secao "Restaurar" abaixo.
            Repita esse download de tempos em tempos e sempre que fizer uma atualizacao importante.
        </p>
        <a href="{{ route('admin.backup.download') }}" class="btn btn-primary">Baixar backup completo agora</a>
    </div>

    <hr>

    <div class="mt-4">
        <h2 class="h6">Restaurar a partir de um backup</h2>
        <div class="alert alert-warning">
            <strong>Atencao:</strong> restaurar substitui TODO o conteudo atual do site (textos,
            noticias, imagens e anexos) pelo conteudo do arquivo de backup enviado. Use somente um
            arquivo <code>.zip</code> gerado pelo botao "Baixar backup" acima, e apenas quando tiver
            certeza — essa acao nao pode ser desfeita pelo painel.
        </div>
        <form method="POST" action="{{ route('admin.backup.restore') }}" enctype="multipart/form-data"
              onsubmit="return confirm('Tem certeza que deseja restaurar este backup? Todo o conteudo atual do site sera substituido.');">
            @csrf
            <div class="mb-3">
                <label class="form-label">Arquivo de backup (.zip)</label>
                <input type="file" name="backup_arquivo" class="form-control" accept=".zip" required>
            </div>
            <button type="submit" class="btn btn-danger">Restaurar este backup</button>
        </form>
    </div>
@endsection
