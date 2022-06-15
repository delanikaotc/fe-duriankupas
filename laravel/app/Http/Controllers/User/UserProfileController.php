<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserProfileController extends Controller 
{
    function index()
    {
        return view('user/user_home', ["title" => "Profil"]);
    }
}