<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DaftarController extends Controller
{
    function index()
    {
        return view('daftar', ["title" => "Daftar"]);
    }

    function daftar(Request $request)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/auth/register';
        $params['form_params'] = array(
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone
        );

        try{
            $action = $client->post($URI, $params);
            $response = json_decode($action->getBody(), true);
            Log::info($response);

            $idUser = cookie('idUser', $response['savedUser']['_id'], 60);
            $tokenCookie = cookie('accessToken', $response['accessToken'], 60);

            return redirect()->route('userProfileView')->withCookies([$tokenCookie, $idUser]);
        }
        catch (Exception $e){
            Log::error($e);
            return redirect()->route('daftarView')->withErrors([$e->getMessage()]);
        }
    }
}
