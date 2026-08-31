<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * Registra em storage/logs/admin.log toda acao que muda algo no site
 * (POST/PUT/PATCH/DELETE dentro do painel admin), para ajudar a investigar
 * qualquer incidente depois. Nao precisa de banco de dados.
 */
class AdminAuditLog
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'], true) && $response->getStatusCode() < 400) {
            Log::channel('admin')->info('acao_admin', [
                'rota' => $request->route()?->getName(),
                'metodo' => $request->method(),
                'ip' => $request->ip(),
                'admin' => $request->session()->get('admin_email'),
                'nivel' => $request->session()->get('admin_nivel'),
            ]);
        }

        return $response;
    }
}
