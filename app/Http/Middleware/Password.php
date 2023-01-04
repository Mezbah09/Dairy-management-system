<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Password
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
        if(Session::exists('key_12ee3nnn')){

            return $next($request);
        }else{

            session(['redirect'=>$request->url()]);
            return redirect()->route('super-password');
        }
    }
}
