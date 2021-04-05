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
        if ($path == 'dashboard/login' && $user) {
            switch ($user->role_id) {
                case 1:
                    return redirect('/dashboard');
                    break;
                case 2:
                    return redirect('/dashboard/cashier');
                    break;
                case 3:
                    return redirect('/dashboard/waiter');
                    break;
                default:
                    return redirect('/dashboard/kitchen');
                    break;
            }
        } else if (!$user && $path != 'dashboard/login') {
            return redirect('dashboard/login');
        } else if ($path == "dashboard" && $user->role_id != 1) {
            return redirect()->back();
        }
         else if ($path == "dashboard/cashier" && $user->role_id != 2) {
            return redirect()->back();
        }
         else if ($path == "dashboard/waiter" && $user->role_id != 3) {
            return redirect()->back();
        }
         else if ($path == "dashboard/kitchen" && $user->role_id != 4) {
            return redirect()->back();
        }
        return $next($request);
    }

    public function redirectToCorrectLocation() {

    }
}
