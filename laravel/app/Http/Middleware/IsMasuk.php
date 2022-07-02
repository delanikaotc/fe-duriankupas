<?php

namespace App\Http\Middleware;

// middleware isMasuk untuk mengecek apakah pengguna memiliki token atau tidak untuk melakukan daftar/masuk
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class IsMasuk
{
    // fungsi yang dijalankan untuk mengecek 
    public function handle(Request $request, Closure $next)
    {
        // jika pengguna tidak memiliki token
        if (empty(Cookie::get('accessToken'))) {
            // pengguna akan dapat melanjutkan aksi selanjutnya
            return $next($request);
        }
        // jika tidak akan diarahkan ke home
        return redirect()->route('home');
    }
}
