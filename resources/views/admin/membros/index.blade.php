@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0">Membros da equipe</h1>
        <a href="{{ route('admin.membros.create') }}" class="btn btn-primary btn-sm">+ Novo membro</a>
    </div>

    <p class="text-muted">
        <strong>Administrador</strong>: acesso total (todas as secoes, backup/restauracao e gerenciar membros).
        <strong>Secretaria</strong>: pode editar o conteudo do site (noticias, eventos, paginas etc.), mas nao
        acessa configuracoes gerais, backup nem esta tela de membros.
    </p>

    @if(empty($items))
        <p class="text-muted">Nenhum membro cadastrado alem da conta administradora principal (definida no .env).</p>
    @else
        <div class="table-responsive">
            <table class="table table-sm align-middle">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Nivel</th>
                        <th class="text-end">Acoes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item['nome'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>
                                <span class="badge {{ $item['nivel'] === 'administrador' ? 'bg-danger' : 'bg-secondary' }}">
                                    {{ $item['nivel'] === 'administrador' ? 'Administrador' : 'Secretaria' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.membros.edit', $item['id']) }}" class="btn btn-outline-primary btn-sm">Editar</a>
                                <form method="POST" action="{{ route('admin.membros.destroy', $item['id']) }}" class="d-inline" onsubmit="return confirm('Excluir este membro? Ele nao vai mais conseguir acessar o painel.');">
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
