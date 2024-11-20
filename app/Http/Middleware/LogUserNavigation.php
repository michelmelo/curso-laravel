<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogUserNavigation
{
    /**
     * Manipula a requisição.
     */
    public function handle(Request $request, Closure $next)
    {
        // Captura o usuário autenticado, se houver
        $user = auth()->user();

        // Formata a mensagem de log
        $message = sprintf(
            "Usuário: %s | Rota: %s | IP: %s | Agente: %s",
            $user ? $user->email : 'Visitante',
            $request->fullUrl(),
            $request->ip(),
            $request->header('User-Agent')
        );

        // Escreve a mensagem nos logs
        Log::channel('navigation')->info($message);

        return $next($request);
    }
}
