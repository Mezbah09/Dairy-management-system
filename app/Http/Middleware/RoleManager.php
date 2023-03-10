<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return $next($request);

        $user = Auth::user();
        if ($user->getRole() == $role) {
            return $next($request);
        } else {
            return redirect()->route($user->getRole() . ".dashboard");
        }
    }
}
