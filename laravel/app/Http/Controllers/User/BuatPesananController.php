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

                $cookiePesanan  =  cookie('pesanan', $action->getBody(), 60);
                $cookieProduk  =  cookie('produk', $actionProduk->getBody(), 60);

                return redirect()->route('buatPesananView')->withCookies([$cookiePesanan, $cookieProduk]);
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

        if ($request->provinsi == 'Pilih Provinsi') {
            return redirect()->route('buatPesananView')->withErrors(['Pilih Provinsi kamu!']);
        }

        if ($request->kota == 'Pilih Kab/Kota') {
            return redirect()->route('buatPesananView')->withErrors(['Pilih Kabupaten/Kota kamu!']);
        }

        if ($request->metodePembayaran == 'Pilih Pembayaran') {
            return redirect()->route('buatPesananView')->withErrors(['Pilih Metode Pembayaran kamu!']);
        }

        $request->validate([
            'provinsi' => ['required'],
            'kota' => ['required'],
            'kecamatan' => ['required'],
            'alamat' => ['required'],
            'kodePos' => ['required']
        ], [
            'provinsi.required' => 'Kamu harus mengisi Provinsi!',
            'kota.required' => 'Kamu harus mengisi Kota!',
            'kecamatan.required' => 'Kamu harus mengisi Kecamatan!',
            'alamat.required' => 'Kamu harus mengisi Alamat!',
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
            return redirect()->route('indexBuatPesanan')->withErrors([$e->getMessage()]);
        }
    }

    function indexBuatPesanan()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/region';

        $action = $client->get($URI);
        $response = json_decode($action->getBody()->getContents(), true);

        $data = json_decode(Cookie::get('profileUser'), true);
        $pesanan = json_decode(Cookie::get('pesanan'), true);
        $produk = json_decode(Cookie::get('produk'), true);

        Log::info($pesanan);
        Log::info($produk);


        return view('user/user_buat_pesanan', [
            'dataPesanan' => $pesanan,
            'dataProduk' => $produk,
            'dataDaerah' => $response,
            'data' => $data,
            'title' => "Buat Pesanan"
        ]);

        Cookie::expire('produk');
        Cookie::expire('pesanan');
    }

    function getKota(Request $request)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/region';

        $action = $client->get($URI);
        $response = json_decode($action->getBody()->getContents(), true);

        Log::info($response);
        $nama_provinsi = $request->nama_provinsi;
        Log::info($nama_provinsi);

        foreach ($response as $provinsi) {
            if ($provinsi['provinsi'] ==  $nama_provinsi) {
                $kota = $provinsi['kota'];
                Log::info($kota);
                foreach ($kota as $k) {
                    echo "<option value='$k'>$k</option>";
                }
            }
        }
    }
}
