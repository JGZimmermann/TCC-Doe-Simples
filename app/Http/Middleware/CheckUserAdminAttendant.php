<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserAdminAttendant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            abort(403, 'Acesso não autorizado.');
        }

        $user = Auth::user();

        if($user->isAdmin() || $user->isAttendant()) {
            return $next($request);
        }

        abort(403, 'Você não tem permissão para acessar este recurso.');
    }
}
