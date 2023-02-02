<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// controller untuk halaman data pemesanan admin
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminDataPemesananController extends Controller
{
    // fungsi untuk menampilkan halaman data pemesanan admin
    function index()
    {
        // URI API untuk mengambil semua data pemesanan pembeli
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/admin/datapesanan';

        // token yang dibutuhkan untuk fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            // mengambil data pesanan lewat API
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $data = json_decode(Cookie::get('profileUser'), true);

            // diarahkan ke halaman data pemesanan dengan data berikut apabila sudah berhasil
            return view('admin/admin_data_pemesanan')->with([
                'data' => $response,
                'dataProfile' => $data,
                'title' => "Data Pemesanan"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang akan dijalankan apabila admin menerima bukti pembayaran
    function terimaBuktiPembayaran($id)
    {
        // API untuk mengubah status pesanan dengan spesifik id
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/admin/pembayaranterverifikasi/' . $id;

        // token yang dibutuhkan 
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );
        try {
            // mengedit status pesanan yang ada di database untuk diinfokan ke halaman pengguna
            $client->put($URI, $params);

            // diarahkan ke halaman data pemesanan dengan pesan sukses
            return redirect()->route('adminDataPemesananView')->with('success', 'Pembayaran berhasil terverifikasi!');
        } catch (Exception $e) {

            Log::error($e);
        }
    }

    // fungsi yang akan dijalankan apabila admin menolak bukti pembayaran kurang lebih sama dengan menerima bukti pembayaran
    function tolakBuktiPembayaran($id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/admin/pembayaranditolak/' . $id;

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );
        try {
            $client->put($URI, $params);
            return redirect()->route('adminDataPemesananView')->with('success', 'Pembayaran berhasil ditolak!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
