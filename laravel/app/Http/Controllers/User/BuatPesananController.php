<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class BuatPesananController extends Controller
{
    function buatPesanan(Request $request)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/pesan';
        $URI2 = 'https://beduriankupas.herokuapp.com/api/users';

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
                $action2 = $client->get($URI2);
                $response = json_decode($action->getBody()->getContents(), true);
                $response2 = json_decode($action2->getBody()->getContents(), true);

                Log::info($response);
                Log::info($response2);

                $data = json_decode(Cookie::get('profileUser'), true);

                return view('user/user_buat_pesanan', [
                    'dataPesanan' => $response,
                    'dataProduk' => $response2,
                    'data' => $data,
                    'title' => "Buat Pesanan"
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);
        }
        return redirect()->back()->withErrors(['Masukkan jumlah!']);
    }

    function updatePesanan(Request $request, $id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/detail/' . $id;

        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        $params['form_params'] = array(
            'total' => $request->total,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'alamat' => $request->alamat
        );

        try {
            $action = $client->put($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            $data = json_decode(Cookie::get('profileUser'), true);

            return view('user/user_pembayaran', [
                'dataPesanan' => $response,
                'data' => $data,
                'title' => "Pembayaran",
                'success' => "Data Pesanan berhasil dibuat!"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
