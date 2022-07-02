<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

// controller untuk halaman pembayaran 
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;


class PembayaranController extends Controller
{
    // menangani data yang dibutuhkan untuk ditampilkan pada halaman pembayaran
    // membutuhkan id pesanan untuk get total pesanan 
    function index($id)
    {
        // URI untuk get data pesanan
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/mytransaction/' . cookie::get('idUser');

        // membutuhkan token user untuk mengakses fungsi ini
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            // fungsi get data pesanan dari API
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            // variabel untuk iterasi
            $i = 0;

            // mengecek jika pesanan memiliki id pesanan yang sama dengan pembayaran yang sedang dilakukan 
            // maka diarahkan ke pembayaran dengan data-data dibawah
            foreach ($response as $pesanan) {
                if ($pesanan['_id'] == $id) {
                    $arrPesanan = $pesanan;
                    return view('user/user_pembayaran')->with([
                        'dataPesanan' => $arrPesanan,
                        'data' => $data,
                        'title' => "Pembayaran"
                    ]);
                    $i++;
                }
            }
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang akan dijalankan apabila pengguna klik button unggah bukti pembayaran sekarang
    function uploadBuktiPembayaran(Request $request, $id)
    {
        //URI get pesanan by id untuk memasukkan bukti gambar pembayaran
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/payment/' . $id;

        //validasi gambar agar tidak bisa diisi kosong atau diisi file selain extension yang diminta
        $request->validate([
            'image' => ['required'], ['mimes:jpeg,jpg,png'],
        ], [
            'image.required' => 'Kamu harus menambahkan gambar bukti!',
            'image.mimes' => 'Gambar harus jpeg, jpg, atau png!'
        ]);

        // membutuhkan token untuk mengakses fungsi ini
        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        // menambahkan variabel yang berisi gambar
        $file = $request->file('image');

        // data yang akan dipassing ke dalam database 
        $params['multipart'] = array(
            [
                'name' => 'image',
                'contents' => file_get_contents($file->getPathname()),
                'filename' => $file->getClientOriginalName()
            ]
        );

        try {
            // mengirimkan data bukti pembayaran ke database lewat URI API
            $action = $client->put($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            // jika berhasil akan diarahkan ke daftar pesanan dengan pesan sukses
            return redirect()->route('userPesananView')->with('success', 'Unggah bukti pembayaran kamu berhasil!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
