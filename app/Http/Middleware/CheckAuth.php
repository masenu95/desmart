<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAuth
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
        if ( ! Auth::check()) {
          return redirect()->route('login')->with('message', 'You must login first to sell your product!');;
        }
        return $next($request);
    }
}
