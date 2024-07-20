<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role)
    {
        if (in_array(Auth::user()->role_id, $role)) {
            return $next($request);
        }
        abort(403, 'Anda tidak memiliki hak mengakses laman tersebut!');
    }
}
