<?php

namespace App\Http\Controllers;

// controller untuk halaman produk kami 
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ProdukController extends Controller
{
    function index()
    {
        // URI untuk mendapatkan data produk
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/users';

        try {
            // comand untuk mendapatkan data dari API menggunakan metode get
            $action = $client->get($URI);
            $response = json_decode($action->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            // diarahkan ke view halaman produk kami dengan assign data yang dibutuhkan pada front end
            return view('produk', [
                'dataProduk' => $response,
                'data' => $data,
                'title' => "Produk Kami"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
