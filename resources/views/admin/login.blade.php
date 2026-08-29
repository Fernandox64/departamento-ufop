<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Entrar no painel | {{ $siteSettings['nome_site'] }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/brand.css') }}">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h1 class="h4 mb-4 text-center">Painel administrativo</h1>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $erro)
                                    <div>{{ $erro }}</div>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.login.attempt') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">E-mail</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Senha</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="remember" value="1" class="form-check-input" id="remember" checked>
                                <label class="form-check-label" for="remember">Lembrar por 30 dias</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        </form>
                    </div>
                </div>
                <p class="text-center text-muted mt-3">
                    <a href="{{ route('home') }}">Voltar para o site</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
