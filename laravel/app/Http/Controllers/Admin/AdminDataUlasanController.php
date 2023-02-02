<?php

namespace App\Http\Controllers\Admin;

// controller untuk halaman data ulasan
use App\Http\Controllers\Controller;
use FFI\Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminDataUlasanController extends Controller
{
    // fungsi untuk menampilkan data ulasan 
    function index()
    {
        // URI API untuk mendapatkan data ulasan dan data pesanan
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/admin/review';
        $URIPesanan = 'https://beduriankupas.tykozidane.xyz/api/admin/datapesanan';

        // token yang dibutuhkan untuk menjalani fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        try {
            // mendapatkan data ulasan dan data pesanan dari database lewat API
            $action = $client->get($URI, $params);
            $actionPesanan = $client->get($URIPesanan, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $responsePesanan = json_decode($actionPesanan->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            // diarahkan ke halaman data ulasan apabila berhasil dengan data berikut
            return view('admin/admin_data_ulasan')->with([
                'data' => $response,
                'dataPesanan' => $responsePesanan,
                'dataProfile' => $data,
                'title' => "Ulasan Pesanan"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
