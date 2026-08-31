<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\MembroStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $conta = $this->autenticar($credentials['email'], $credentials['password']);

        if (! $conta) {
            Log::channel('admin')->warning('login_falhou', [
                'email_tentado' => $credentials['email'],
                'ip' => $request->ip(),
            ]);

            return back()
                ->withErrors(['email' => 'E-mail ou senha invalidos.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();
        $request->session()->put('admin_logged_in', true);
        $request->session()->put('admin_nome', $conta['nome']);
        $request->session()->put('admin_email', $conta['email']);
        $request->session()->put('admin_nivel', $conta['nivel']);

        if ($request->boolean('remember')) {
            Cookie::queue('admin_remember', hash('sha256', $conta['email'].'|'.$conta['senha_hash']), 60 * 24 * 30);
        }

        Log::channel('admin')->info('login_sucesso', [
            'admin' => $conta['email'],
            'nivel' => $conta['nivel'],
            'ip' => $request->ip(),
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Log::channel('admin')->info('logout', [
            'admin' => session('admin_email'),
            'ip' => $request->ip(),
        ]);

        $request->session()->forget(['admin_logged_in', 'admin_nome', 'admin_email', 'admin_nivel']);
        $request->session()->regenerate();
        Cookie::queue(Cookie::forget('admin_remember'));

        return redirect()->route('admin.login');
    }

    /**
     * Verifica as credenciais contra a conta raiz (.env) e, se nao bater,
     * contra os membros cadastrados em app/Support/MembroStore.
     */
    protected function autenticar(string $email, string $password): ?array
    {
        $rootEmail = config('admin.email');
        $rootHash = config('admin.password_hash');

        if ($rootHash && strcasecmp($email, (string) $rootEmail) === 0 && Hash::check($password, $rootHash)) {
            return [
                'nome' => 'Administrador',
                'email' => $rootEmail,
                'senha_hash' => $rootHash,
                'nivel' => 'administrador',
            ];
        }

        $membro = MembroStore::findByEmail($email);
        if ($membro && Hash::check($password, $membro['senha_hash'])) {
            return $membro;
        }

        return null;
    }
}
