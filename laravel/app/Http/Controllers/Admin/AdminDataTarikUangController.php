<?php

namespace App\Http\Controllers\Admin;

// controller untuk halaman data tarik uang 
use App\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminDataTarikUangController extends Controller
{
    // fungsi untuk menampilkan halaman data tarik uang 
    function index()
    {
        // URI untuk mengambil data tarik uang 
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/admin/datatarikuang';
        $URIReseller = 'https://beduriankupas.tykozidane.xyz/api/admin/datareseller';


        // token untuk menjalankan fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            // mengambil data reseller dan data penarikan uang dari database lewat API
            $action = $client->get($URI, $params);
            $actionReseller = $client->get($URIReseller, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $responseReseller = json_decode($actionReseller->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            // diarahkan ke halaman data tarik uang jika berhasil dengan data berikut
            return view('admin/admin_data_tarik_uang')->with([
                'data' => $response,
                'dataReseller' => $responseReseller,
                'dataProfile' => $data,
                'title' => "Data Tarik Uang"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
