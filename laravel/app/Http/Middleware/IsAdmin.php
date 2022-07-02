<?php

namespace App\Http\Middleware;

// middleware isAdmin untuk mengecek apakah role pengguna merupakan admin atau bukan
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class IsAdmin
{
    // fungsi untuk mengecek
    public function handle(Request $request, Closure $next)
    {
        // jika roleuser pada cookie adalah admin
        if (Cookie::get('roleUser') == 'admin') {
            // pengguna dapat melanjutkan aksinya
            return $next($request);
        }
        // jika tidak akan diarahkan kembali ke home dengan error
        return redirect()->route('home')->withErrors(['Kamu tidak memiliki akses!']);
    }
}
