<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotPegawai
{
    public function handle($request, Closure $next, $guard = "pegawais")
    {
        if (!auth()->guard($guard)->check()) {
            return redirect(route('Login'));
        }
        return $next($request);
    }
}