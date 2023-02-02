<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;

// controller untuk halaman data tarik uang reseller
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ResellerDataTarikUangController extends Controller
{
    // fungsi untuk menampilkan halaman data tarik uang 
    function index()
    {
        // URI API untuk mengambil data penarikan uang yang dilakukan oleh spesifik reseller
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/reseller/datatarikuang';

        // token yang dibutuhkan 
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            // mengambil data dari database lewat API
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            // diarahkan ke halaman data tarik uang dengan data berikut jika berhasil
            return view('reseller/reseller_data_tarik_uang')->with([
                'dataProfile' => $data,
                'data' => $response,
                'title' => "Data Tarik Uang"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
