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

    function buatPesanan(Request $request)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/pesan';
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        $input = $request->all();
        $semuaProduk = [];

        foreach ($input['ArrPesanan'] as $i) {
            if ($i['jumlah'] > 0 && $i['jumlah'] != null) {
                array_push($semuaProduk, $i);
            }
        }

        $params['form_params'] = array(
            'userId' => Cookie::get('idUser'),
            'pesanan' => $semuaProduk
        );
        Log::info($semuaProduk);

        try {
            if (!empty($semuaProduk)) {
                $action = $client->post($URI, $params);
                $response = json_decode($action->getBody()->getContents(), true);
                Log::info($response);

                $data = json_decode(Cookie::get('profileUser'), true);

                return view('buat_pesanan', [
                    'dataPesanan' => $response,
                    'data' => $data,
                    'title' => "Buat Pesanan"
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);
        }
        return redirect()->back()->withErrors(['Masukkan jumlah!']);
    }
}
