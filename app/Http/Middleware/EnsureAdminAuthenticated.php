<?php

namespace App\Http\Middleware;

use App\Support\MembroStore;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->get('admin_logged_in')) {
            return $next($request);
        }

        $remember = $request->cookie('admin_remember');

        if ($remember && $this->autenticarPorRemember($request, $remember)) {
            return $next($request);
        }

        return redirect()->route('admin.login');
    }

    protected function autenticarPorRemember(Request $request, string $remember): bool
    {
        $rootEmail = (string) config('admin.email');
        $rootHash = config('admin.password_hash');

        if ($rootHash && hash_equals(hash('sha256', $rootEmail.'|'.$rootHash), $remember)) {
            $this->iniciarSessao($request, 'Administrador', $rootEmail, 'administrador');

            return true;
        }

        foreach (MembroStore::all() as $membro) {
            if (hash_equals(hash('sha256', $membro['email'].'|'.$membro['senha_hash']), $remember)) {
                $this->iniciarSessao($request, $membro['nome'], $membro['email'], $membro['nivel']);

                return true;
            }
        }

        return false;
    }

    protected function iniciarSessao(Request $request, string $nome, string $email, string $nivel): void
    {
        $request->session()->put('admin_logged_in', true);
        $request->session()->put('admin_nome', $nome);
        $request->session()->put('admin_email', $email);
        $request->session()->put('admin_nivel', $nivel);
    }
}
