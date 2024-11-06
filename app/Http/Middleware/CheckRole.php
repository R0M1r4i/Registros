<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Debes iniciar sesión para acceder.');
        }

        // Obtener el rol del usuario
        $userRole = Auth::user()->rol;

        // Si el usuario es admin, permitir acceso a todas las rutas
        if ($userRole === 'admin') {
            return $next($request);
        }

        // Para otros roles, verificar si coincide exactamente
        if ($userRole !== $role) {
            return redirect('/error')->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}
