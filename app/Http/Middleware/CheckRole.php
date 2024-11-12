<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckRole
{
        /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @param  string  $role
    * @return mixed
    */
   public function handle(Request $request, Closure $next, string $role)
   {
    //    // Verificar si el usuario está autenticado y tiene el rol requerido
    //    if (!Auth::check() || Auth::user()->role !== $role) {
    //        // Si no tiene el rol, devolver un error 403 (Forbidden)
    //        abort(403, 'Unauthorized access');
    //    }

    //    // Si tiene el rol, permitir acceso a la ruta
    //    return $next($request);
    if (!Auth::check()) {
        return redirect('login');
    }

    // Convertir los roles en array
    $rolesArray = explode(',', $roles);
    
    // Verificar si el usuario tiene el rol necesario
    if (!in_array(Auth::user()->role, $rolesArray)) {
        return redirect()
            ->back()
            ->with('error', 'No tienes los permisos necesarios para acceder a esta sección.');
    }

    return $next($request);
}
   
}



