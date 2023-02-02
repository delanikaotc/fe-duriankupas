<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;

// controller untuk tampilan halaman data restock 
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ResellerDataRestockController extends Controller
{
    // fungsi untuk menampilkan tampilan data restock
    function index()
    {
        // URI API untuk mengambil data restock
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/reseller/datarestock';

        // token yang dibutuhkan
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            // mengambil data restock dari database lewat API 
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            // jika berhasil diarahkan ke halaman data restock dengan data berikut
            return view('reseller/reseller_data_restock')->with([
                'dataProfile' => $data,
                'data' => $response,
                'title' => "Data Restock"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
