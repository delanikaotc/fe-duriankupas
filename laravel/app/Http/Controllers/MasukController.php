<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class MasukController extends Controller
{
    function index()
    {
        return view('masuk', ["title" => "Masuk"]);
    }

    function keluar()
    {
        Cookie::expire('accessToken');
        Cookie::expire('idUser');

        return redirect()->route('home');
    }
}