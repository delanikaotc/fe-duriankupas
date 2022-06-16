<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class IsReseller
{
    public function handle(Request $request, Closure $next)
    {
        if(Cookie::get('roleUser') == 'reseller') {
            return $next($request);
        }
        return redirect()->route('home')->withErrors(['Kamu tidak memiliki akses!']);
    }
}
