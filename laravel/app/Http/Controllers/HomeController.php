<?php

namespace App\Http\Controllers;

// controller untuk mengambil data untuk data yang dibutuhkan pada home lewat controller
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    function index()
    {
        // assign new client untuk mengambil data pada link uri api 
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/users';

        // menggunakan try catch agar tidak langsung berhenti ketika menemukan error
        try {
            // get data dari database lewat uri api
            $action = $client->get($URI);

            // mengubah data yang didapatkan dari api menjadi array 
            $response = json_decode($action->getBody()->getContents(), true);

            // data profile user 
            $data = json_decode(Cookie::get('profileUser'), true);

            // return view apabila berhasil
            return view('home', [
                'dataProduk' => $response,
                'data' => $data,
                'title' => "duriankupas.id"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
