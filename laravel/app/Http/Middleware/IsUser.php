<?php

namespace App\Http\Middleware;

// middleware isUser untuk mengecek apakah role pengguna merupakan user atau bukan
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class IsUser
{
    // fungsi untuk mengecek
    public function handle(Request $request, Closure $next)
    {
        // jika roleuser pada cookie adalah user
        if (Cookie::get('roleUser') == 'user') {
            // pengguna dapat melanjutkan aksinya
            return $next($request);
        }
        // jika tidak akan diarahkan kembali ke home dengan error
        return redirect()->route('home')->withErrors(['Kamu tidak memiliki akses!']);
    }
}
