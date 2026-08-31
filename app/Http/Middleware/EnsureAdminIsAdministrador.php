<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Bloqueia contas de nivel "secretaria" de areas restritas a administrador
 * (configuracoes gerais, backup/restauracao e gerenciamento de membros).
 */
class EnsureAdminIsAdministrador
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless($request->session()->get('admin_nivel') === 'administrador', 403, 'Apenas administradores podem acessar esta area.');

        return $next($request);
    }
}
