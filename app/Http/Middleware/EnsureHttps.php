<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * So redireciona para HTTPS quando FORCE_HTTPS=true no .env. Fica desligado
 * por padrao para nao quebrar o acesso enquanto o dominio final ainda nao tem
 * certificado configurado — ligue apos confirmar que o HTTPS funciona.
 */
class EnsureHttps
{
    public function handle(Request $request, Closure $next): Response
    {
        if (config('app.force_https') && ! $request->secure()) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
