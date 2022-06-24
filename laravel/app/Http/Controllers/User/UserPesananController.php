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

    function pesananSampai($id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/transaksiselesai/' . $id;

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            $client->put($URI, $params);
            return redirect()->route('userPesananView')->with('success', 'Terima kasih telah memesan durian kami! Selamat menikmati!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function rincianPesanan($id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/transaksi/' . $id;
        $URIProduk = 'https://beduriankupas.herokuapp.com/api/users';

        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        $data = json_decode(Cookie::get('profileUser'), true);

        try {
            $action = $client->get($URI, $params);
            $actionProduk = $client->get($URIProduk);
            $response = json_decode($action->getBody()->getContents(), true);
            $responseProduk = json_decode($actionProduk->getBody()->getContents(), true);

            Log::info($response);

            return view('user/user_rincian_pesanan')->with([
                'dataProfile' => $data,
                'dataProduk' => $responseProduk,
                'data' => $response,
                'title' => "Rincian Pesanan"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
