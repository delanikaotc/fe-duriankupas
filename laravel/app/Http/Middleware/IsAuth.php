<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class isAuth
{
    public function handle(Request $request, Closure $next)
    {
        if(!empty(Cookie::get('accessToken'))) {
            return $next($request);
        }
        return redirect()->route('home');
    }
}