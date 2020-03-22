<?php

namespace App\Http\Middleware;

use Closure;

class Secretaria
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->rol=='Secretaria' or $request->user()->rol=='Admin'){
            return $next($request);
        } else {
            dd('acceso denegado');
        }
    }
}
