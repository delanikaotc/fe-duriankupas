<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ProdukController extends Controller
{
    function index()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users';

        try {
            $action = $client->get($URI);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            $data = json_decode(Cookie::get('profileUser'), true);

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
