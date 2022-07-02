<?php

namespace App\Http\Controllers\User;

// controller untuk halaman beri ulasan 
use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class BeriUlasanController extends Controller
{
    // fungsi untuk menampilkan halaman beriulasan dengan data yang diminta untuk ditampilkan 
    function index($id)
    {
        // URI untuk get pesanan yang akan diberi ulasan, diambil by id pesanan
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/transaksi/' . $id;

        // token untuk mengakses fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        $data = json_decode(Cookie::get('profileUser'), true);

        try {
            // mengambil data melalui API dari database
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            // diarahkan ke halaman beri ulasan apabila berhasil dengan data berikut
            return view('user/user_beri_ulasan')->with([
                'data' => $data,
                'dataPesanan' => $response,
                'title' => "Beri Ulasan"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang dijalankan apabila pengguna menekan button kirim pada halaman beri ulasan 
    function kirimUlasan(Request $request, $id)
    {
        // mengirimkan data ke database menggunakan URI API
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/rating/' . $id;


        // validasi data rating dan ulasan yang didapat
        $request->validate([
            'rating' => ['required', 'numeric'],
            'review' => ['required', 'max:255'],
        ], [
            'rating.required' => 'Kamu harus mengisi Rating!',
            'rating.numeric' => 'Rating harus angka!',
            'review.required' => 'Kamu harus mengisi Ulasan!',
            'review.max' => 'Ulasan maksimal 255 karakter!',
        ]);

        // token untuk mengakses fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        // data yang dibutuhkan ketika dikirim ke database
        $params['form_params'] = array(
            'rating' => $request->rating,
            'review' => $request->review
        );

        try {
            // mengirimkan data yang diterima dari front end ke database 
            $action = $client->post($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            // mengarahkan ke halaman pesanan dengan pesan success
            return redirect()->route('userPesananView')->with('success', 'Ulasan berhasil ditambahkan!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
