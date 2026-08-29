<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        $adminEmail = config('admin.email');
        $adminHash = config('admin.password_hash');

        $valid = $adminHash
            && strcasecmp($credentials['email'], (string) $adminEmail) === 0
            && Hash::check($credentials['password'], $adminHash);

        if (! $valid) {
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

        if ($request->boolean('remember')) {
            Cookie::queue('admin_remember', hash('sha256', $adminHash), 60 * 24 * 30);
        }

        Log::channel('admin')->info('login_sucesso', [
            'admin' => $adminEmail,
            'ip' => $request->ip(),
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Log::channel('admin')->info('logout', [
            'admin' => config('admin.email'),
            'ip' => $request->ip(),
        ]);

        $request->session()->forget('admin_logged_in');
        $request->session()->regenerate();
        Cookie::queue(Cookie::forget('admin_remember'));

        return redirect()->route('admin.login');
    }
}
