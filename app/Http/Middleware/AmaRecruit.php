<?php

namespace App\Http\Middleware;

use Closure;

class AmaRecruit
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
        if (!isset(auth()->user()->team->proama) || auth()->user()->team->proama != 1 || auth()->user()->leader != 0) {
            return redirect('/myteam#recruit');
        }

        return $next($request);
    }
}
