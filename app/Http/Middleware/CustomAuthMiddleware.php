<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomAuthMiddleware
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
        $path = $request->path();
        $user = session('userLogin');
        if ($path == "dashboard/login" && $user) {
            return redirect('/dashboard');
        } else if (!$user && $path != 'dashboard/login') {
            return redirect('dashboard/login');
        } 
        return $next($request);
    }
}
