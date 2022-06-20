<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class UserPesananController extends Controller
{
    function index()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/mytransaction/' . cookie::get('idUser');

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );
        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            $data = json_decode(Cookie::get('profileUser'), true);

            return view('user/user_pesanan')->with([
                'dataPesanan' => $response,
                'data' => $data,
                'title' => "Pesanan Saya"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
