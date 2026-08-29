<?php

namespace App\Http\Middleware;

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

        $adminHash = config('admin.password_hash');
        $remember = $request->cookie('admin_remember');

        if ($adminHash && $remember && hash_equals(hash('sha256', $adminHash), $remember)) {
            $request->session()->put('admin_logged_in', true);

            return $next($request);
        }

        return redirect()->route('admin.login');
    }
}
