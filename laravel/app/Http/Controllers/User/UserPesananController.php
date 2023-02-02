<?php

namespace App\Http\Controllers\User;

// controller untuk halaman daftar pesanan user
use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class UserPesananController extends Controller
{
    // fungsi untuk menampilkan halaman pesanan user
    function index()
    {
        // API untuk mendapatkan transaksi yang pernah dilakukan oleh pengguna dari id user
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/users/mytransaction/' . cookie::get('idUser');

        // token yang dibutuhkan untuk menjalankan fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            // mengambil data transaksi dari database lewat API
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            // diarahkan ke halaman daftar pesanan user dengan data berikut
            return view('user/user_pesanan')->with([
                'dataPesanan' => $response,
                'data' => $data,
                'title' => "Pesanan Saya"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang dijalankan apabila pengguna menekan button pesanan sudah sampai
    function pesananSampai($id)
    {
        // mendapatkan data transaksi yang sudah selesai dari spesifik id pesanan
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/users/transaksiselesai/' . $id;

        // token yang dibutuhkan untuk mengakses fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            // mengubah status transaksi menjadi selesai di database lewat API
            $client->put($URI, $params);
            // diarahkan kembali ke halaman daftar pesanan dengan pesan success
            return redirect()->route('userPesananView')->with('success', 'Terima kasih telah memesan durian kami! Selamat menikmati!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang akan dijalankan jika pengguna menekan button rincian pesanan
    function rincianPesanan($id)
    {
        // URI untuk mendapatkan data transaksi dan data produk
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/users/transaksi/' . $id;
        $URIProduk = 'https://beduriankupas.tykozidane.xyz/api/users';

        // token yang dibutuhkan untuk menjalankan fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        $data = json_decode(Cookie::get('profileUser'), true);

        try {
            // mendapatkan data pesanan dan data produk lewat API
            $action = $client->get($URI, $params);
            $actionProduk = $client->get($URIProduk);
            $response = json_decode($action->getBody()->getContents(), true);
            $responseProduk = json_decode($actionProduk->getBody()->getContents(), true);

            // diarahkan ke halaman rincian pesanan dengan data berikut
            return view('user/user_rincian_pesanan')->with([
                'dataProfile' => $data,
                'dataProduk' => $responseProduk,
                'data' => $response,
                'title' => "Rincian Pesanan"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
