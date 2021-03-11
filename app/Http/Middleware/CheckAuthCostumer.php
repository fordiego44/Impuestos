<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthCostumer
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
      if (!$request->session()->exists('costumer')) {
        return redirect()->route('principal');
      }
      return $next($request);
    }
}
