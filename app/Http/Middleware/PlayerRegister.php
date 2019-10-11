<?php

namespace App\Http\Middleware;

use Closure;

class PlayerRegister
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
        if (isset(auth()->user()->player)) {
            return redirect()->route('routeMyPlayer');
        }

        return $next($request);
    }
}
