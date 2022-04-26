<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Kontributor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->level=='kontributor')
        {
            return $next($request);
        }
        else
        {
        return redirect('/');
        }
    }
}
