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
        $URIProduk = 'https://beduriankupas.herokuapp.com/api/users';

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
                $actionProduk = $client->get($URIProduk);
                $response = json_decode($action->getBody()->getContents(), true);
                $responseProduk = json_decode($actionProduk->getBody()->getContents(), true);

                Log::info($response);
                Log::info($responseProduk);

                $data = json_decode(Cookie::get('profileUser'), true);

                return view('user/user_buat_pesanan', [
                    'dataPesanan' => $response,
                    'dataProduk' => $responseProduk,
                    'data' => $data,
                    'title' => "Buat Pesanan"
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);
        }
        return redirect()->back()->withErrors(['Masukkan jumlah dengan benar!']);
    }

    function updatePesanan(Request $request, $id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/detail/' . $id;

        $request->validate([
            'provinsi' => ['required'],
            'kota' => ['required'],
            'kecamatan' => ['required'],
            'alamat' => ['required'],
            'metodePembayaran' => ['required'],
            'kodePos' => ['required']
        ], [
            'provinsi.required' => 'Kamu harus mengisi Provinsi!',
            'kota.required' => 'Kamu harus mengisi Kota!',
            'kecamatan.required' => 'Kamu harus mengisi Kecamatan!',
            'alamat.required' => 'Kamu harus mengisi Alamat!',
            'metodePembayaran.required' => 'Kamu harus mengisi  Metode Pembayaran!',
            'kodePos.required' => 'Kamu harus mengisi Kode Pos!',
        ]);

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

    // function indexBuatPesanan($id)
    // {
    //     $client = new Client();
    //     $URI = 'https://beduriankupas.herokuapp.com/api/users/transaksi/' . $id;

    //     $params['headers'] = array(
    //         'token' => 'Bearer ' . Cookie::get('accessToken'),
    //     );

    //     try {
    //         $action = $client->get($URI, $params);
    //         $response = json_decode($action->getBody()->getContents(), true);
    //         Log::info($response);

    //         $data = json_decode(Cookie::get('profileUser'), true);

    //         return redirect()->route('buatPesanan');
    //     } catch (Exception $e) {
    //         Log::error($e);
    //     }
    // }
}
