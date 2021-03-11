<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthRepartidor
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
      if (!$request->session()->exists('deliverier')) {
        return redirect()->route('login.repartidor');
      }
      return $next($request);
    }
}
