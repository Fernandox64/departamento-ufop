@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0">Noticias e Editais</h1>
        <a href="{{ route('admin.noticias.create') }}" class="btn btn-primary btn-sm">+ Nova publicacao</a>
    </div>

    @if(empty($items))
        <p class="text-muted">Nenhuma publicacao cadastrada ainda.</p>
    @else
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
                            <td class="text-end">
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
    @endif
@endsection
