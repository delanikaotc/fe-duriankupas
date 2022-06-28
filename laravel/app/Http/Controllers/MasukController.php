<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use GuzzleHttp\Exception\ClientException;

class MasukController extends Controller
{
    function index()
    {
        return view('masuk', ["title" => "Masuk"]);
    }

    function masuk(Request $request)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/auth/login';

        $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ], [
            'username.required' => 'Kamu harus mengisi Username!',
            'password.required' => 'Kamu harus mengisi Kata Sandi!',
        ]);

        $params['form_params'] = array(
            'username' => $request->username,
            'password' => $request->password
        );

        try {
            $action = $client->post($URI, $params);
            $responseJson = $action->getBody();
            $response = json_decode($responseJson, true);

            $profile = cookie('profileUser', $responseJson, 60);
            $idUser = cookie('idUser', $response['_id'], 60);
            $roleUser = cookie('roleUser', $response['role'], 60);
            $tokenCookie = cookie('accessToken', $response['accessToken'], 60);

            Log::info($profile);
            Log::info($roleUser);

            if ($response['role'] == 'user') {
                return redirect()->route('userProfileView')->withCookies([$tokenCookie, $idUser, $profile, $roleUser]);
            } elseif ($response['role'] == 'reseller') {
                return redirect()->route('resellerDashboardView')->withCookies([$tokenCookie, $idUser, $profile, $roleUser]);
            } elseif ($response['role'] == 'admin') {
                return redirect()->route('adminDataPemesananView')->withCookies([$tokenCookie, $idUser, $profile, $roleUser]);
            }
        } catch (ClientException  $e) {
            Log::error($e);
            $responseError = $e->getResponse();
            $responseErrorBodyAsString = $responseError->getBody()->getContents();

            return redirect()->route('masukView')->withErrors([$responseErrorBodyAsString]);
        }
    }

    function keluar()
    {
        Cookie::expire('accessToken');
        Cookie::expire('idUser');
        Cookie::expire('profileUser');
        Cookie::expire('roleUser');

        return redirect()->route('home');
    }
}
