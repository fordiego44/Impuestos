<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthAdmin
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
      if (!$request->session()->exists('admin')) {
        return redirect()->route('view.login.admin');
      }
      return $next($request);
    }
}
