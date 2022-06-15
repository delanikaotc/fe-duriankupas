<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class UserProfileController extends Controller 
{
    function index()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/profile/' . Cookie::get('idUser');

        $params['headers'] = array (
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        try{
            $action= $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            return view('user/user_home')->with([
                'data' => $response,
                'title' =>"Profil"
            ]);
        }
        catch (Exception $e){
            Log::error($e);
        }
    }

}