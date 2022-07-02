<?php

namespace App\Http\Middleware;

// middleware isAuth untuk mengecek apakah pengguna memiliki akses ke aksi selanjutnya
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class IsAuth
{
    // fungsi untuk mengecek
    public function handle(Request $request, Closure $next)
    {
        // jika pengguna memiliki token
        if (!empty(Cookie::get('accessToken'))) {
            // pengguna dapat melanjutkan ke aksi selanjutnya
            return $next($request);
        }
        // jika tidak akan diarahkan ke halaman login dengan error
        return redirect()->route('masukView')->withErrors(['Kamu belum login!']);
    }
}
