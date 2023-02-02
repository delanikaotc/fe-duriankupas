<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// controller untuk halaman data restock
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminDataRestockController extends Controller
{
    // fungsi untuk menampilkan halaman data restock
    function index()
    {
        // API untuk mengambil data restock dan data reseller dari database
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/admin/datarestock';
        $URIToko = 'https://beduriankupas.tykozidane.xyz/api/admin/dataReseller';

        // token yang dibutuhkan
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            // mengambil data reseller dan data restock dari database lewat API
            $action = $client->get($URI, $params);
            $actionToko = $client->get($URIToko, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $responseToko = json_decode($actionToko->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);


            // diarahkan ke halaman data restock apabila berhasil dengan data berikut
            return view('admin/admin_data_restock')->with([
                'dataToko' => $responseToko['semuatoko'],
                'dataProfile' => $data,
                'data' => $response,
                'title' => "Data Restock"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang akan dijalankan apabila admin menekan button kirim
    function kirimRestock($id)
    {
        // API untuk mengubah status data restock dengan id 
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/admin/restockdikirim/' . $id;

        // token yang dibutuhkan
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );
        try {
            // mengedit status dari data restock menjadi dikirim
            $client->put($URI, $params);
            // diarahkan kembali ke halaman data restock dengan pesan success
            return redirect()->route('adminDataRestockView')->with('success', 'Restock sudah dikirim!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
