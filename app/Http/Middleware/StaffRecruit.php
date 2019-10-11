<?php

namespace App\Http\Middleware;

use Closure;

class StaffRecruit
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
        if (empty(auth()->user()->team) || auth()->user()->leader === null) {
            return redirect('/myteam#recruit');
        }

        return $next($request);
    }
}
