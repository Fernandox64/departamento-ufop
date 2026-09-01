@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0">Noticias e Editais</h1>
        <a href="{{ route('admin.noticias.create') }}" class="btn btn-primary btn-sm">+ Nova publicacao</a>
    </div>

    {{-- Filtro por tipo. Mantem o ano escolhido; se aquele ano nao tiver
         publicacoes do novo tipo, o controller cai no mais recente. --}}
    <div class="d-flex gap-2 mb-2 flex-wrap">
        <a href="{{ route('admin.noticias.index', ['ano' => $anoSelecionado]) }}"
           class="btn btn-sm {{ !$tipo ? 'btn-primary' : 'btn-outline-secondary' }}">Todas</a>
        <a href="{{ route('admin.noticias.index', ['tipo' => 'noticia', 'ano' => $anoSelecionado]) }}"
           class="btn btn-sm {{ $tipo === 'noticia' ? 'btn-primary' : 'btn-outline-secondary' }}">Noticias</a>
        <a href="{{ route('admin.noticias.index', ['tipo' => 'edital', 'ano' => $anoSelecionado]) }}"
           class="btn btn-sm {{ $tipo === 'edital' ? 'btn-primary' : 'btn-outline-secondary' }}">Editais</a>
    </div>

    {{-- Filtro por ano de publicacao. --}}
    @if(!empty($anos))
        <div class="d-flex gap-1 mb-3 flex-wrap align-items-center">
            <span class="text-muted small me-1">Ano:</span>
            @foreach($anos as $ano)
                <a href="{{ route('admin.noticias.index', array_filter(['tipo' => $tipo, 'ano' => $ano])) }}"
                   class="btn btn-sm {{ $anoSelecionado === $ano ? 'btn-primary' : 'btn-outline-secondary' }}">{{ $ano }}</a>
            @endforeach
            <a href="{{ route('admin.noticias.index', array_filter(['tipo' => $tipo, 'ano' => 'todos'])) }}"
               class="btn btn-sm ms-1 {{ $anoSelecionado === 'todos' ? 'btn-primary' : 'btn-outline-secondary' }}">Todos os anos</a>
        </div>
    @endif

    @if($items->isEmpty())
        <p class="text-muted">Nenhuma publicacao encontrada com esses filtros.</p>
    @else
        <p class="text-muted small mb-2">
            {{ $total }} {{ $total === 1 ? 'publicacao' : 'publicacoes' }}
            @if($anoSelecionado !== 'todos') em {{ $anoSelecionado }} @endif
            @if($items->lastPage() > 1)
                — pagina {{ $items->currentPage() }} de {{ $items->lastPage() }}
            @endif
        </p>

        <div class="table-responsive">
            <table class="table table-sm align-middle">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Titulo</th>
                        <th>Data</th>
                        <th class="text-end">Acoes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td><span class="badge noticia-badge-{{ $item['tipo'] }}">{{ $item['tipo'] === 'edital' ? 'Edital' : 'Noticia' }}</span></td>
                            <td>{{ $item['titulo'] }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($item['data_publicacao'])->format('d/m/Y') }}</td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('noticias.show', $item['id']) }}" target="_blank" class="btn btn-outline-secondary btn-sm">Ver</a>
                                <a href="{{ route('admin.noticias.edit', $item['id']) }}" class="btn btn-outline-primary btn-sm">Editar</a>
                                <form method="POST" action="{{ route('admin.noticias.destroy', $item['id']) }}" class="d-inline" onsubmit="return confirm('Excluir esta publicacao?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($items->lastPage() > 1)
            <div class="mt-3">
                {{ $items->links('pagination::bootstrap-5') }}
            </div>
        @endif
    @endif
@endsection
