<?php

namespace App\Http\Middleware;

// middlware isReseller untuk mengecek role pengguna apakah reseller atau bukan
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class IsReseller
{
    // fungsi untuk mengecek
    public function handle(Request $request, Closure $next)
    {
        // jika roleuser pada cookie adalah reseller
        if (Cookie::get('roleUser') == 'reseller') {
            // pengguna dapat melanjutkan aksinya
            return $next($request);
        }
        // jika tidak akan diarahkan kembali ke home dengan error
        return redirect()->route('home')->withErrors(['Kamu tidak memiliki akses!']);
    }
}
