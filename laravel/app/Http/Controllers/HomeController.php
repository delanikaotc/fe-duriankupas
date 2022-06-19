<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    function index()
    {
        $data = json_decode(Cookie::get('profileUser'), true);
        Log::info($data);
        return view('home', [
            'data' => $data,
            'title' => "duriankupas.id"
        ]);
    }
}
