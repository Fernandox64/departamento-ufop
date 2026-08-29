@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0">Eventos</h1>
        <a href="{{ route('admin.eventos.create') }}" class="btn btn-primary btn-sm">+ Novo evento</a>
    </div>

    <form method="POST" action="{{ route('admin.eventos.visibilidade') }}" class="mb-4 p-3 border rounded-3">
        @csrf
        <div class="form-check form-switch">
            <input type="checkbox" name="mostrar_menu" value="1" class="form-check-input" id="mostrar_menu" @checked($mostrarMenu) onchange="this.form.requestSubmit()">
            <label class="form-check-label" for="mostrar_menu">Mostrar "Eventos" no menu principal do site</label>
        </div>
        <small class="text-muted">A pagina de eventos continua acessivel mesmo com o menu desligado.</small>
    </form>

    @if(empty($items))
        <p class="text-muted">Nenhum evento cadastrado ainda.</p>
    @else
        <div class="table-responsive">
            <table class="table table-sm align-middle">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Titulo</th>
                        <th>Local</th>
                        <th class="text-end">Acoes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ \Illuminate\Support\Carbon::parse($item['data_evento'])->format('d/m/Y') }}</td>
                            <td>{{ $item['titulo'] }}</td>
                            <td>{{ $item['local'] }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.eventos.edit', $item['id']) }}" class="btn btn-outline-primary btn-sm">Editar</a>
                                <form method="POST" action="{{ route('admin.eventos.destroy', $item['id']) }}" class="d-inline" onsubmit="return confirm('Excluir este evento?');">
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
