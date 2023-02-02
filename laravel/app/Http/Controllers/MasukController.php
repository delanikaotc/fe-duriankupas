<?php

namespace App\Http\Controllers;

// controller untuk halaman masuk
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use GuzzleHttp\Exception\ClientException;

class MasukController extends Controller
{
    // fungsi untuk menampilkan halaman masuk
    function index()
    {
        // diarahkan ke tampilan halaman masuk dengan judul berikut
        return view('masuk', ["title" => "Masuk"]);
    }

    // fungsi yang dijalankan apabila pengguna menekan tombol masuk
    function masuk(Request $request)
    {
        // API untuk mengirimkan data untuk dicek untuk melakukan proses masuk
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/auth/login';

        // validasi input
        $request->validate([
            'username' => ['required', 'regex:/(^[a-zA-Z]+[a-zA-Z0-9\\-]*$)/u'],
            'password' => ['required']
        ], [
            'username.required' => 'Kamu harus mengisi Username!',
            'username.regex' => 'Username hanya bisa menggunakan tulisan dan angka!',
            'password.required' => 'Kamu harus mengisi Kata Sandi!',
        ]);

        // data yang dibutuhkan untuk dikirimkan 
        $params['form_params'] = array(
            'username' => $request->username,
            'password' => $request->password
        );

        try {
            // mengirimkan data yang dicek untuk masuk lewat API
            $action = $client->post($URI, $params);
            $responseJson = $action->getBody();
            $response = json_decode($responseJson, true);

            // membuat cookie untuk pengguna menggunakan website selama masuk
            $profile = cookie('profileUser', $responseJson, 60);
            $idUser = cookie('idUser', $response['_id'], 60);
            $roleUser = cookie('roleUser', $response['role'], 60);
            $tokenCookie = cookie('accessToken', $response['accessToken'], 60);

            // mengarahkan pengguna ke halaman masing-masing sesuai role
            if ($response['role'] == 'user') {
                return redirect()->route('userProfileView')->withCookies([$tokenCookie, $idUser, $profile, $roleUser]);
            } elseif ($response['role'] == 'reseller') {
                return redirect()->route('resellerDashboardView')->withCookies([$tokenCookie, $idUser, $profile, $roleUser]);
            } elseif ($response['role'] == 'admin') {
                return redirect()->route('adminDataPemesananView')->withCookies([$tokenCookie, $idUser, $profile, $roleUser]);
            }
        } catch (ClientException  $e) {
            Log::error($e);
            $responseError = $e->getResponse();
            $responseErrorBodyAsString = $responseError->getBody()->getContents();

            return redirect()->route('masukView')->withErrors([$responseErrorBodyAsString]);
        }
    }

    // fungsi yang dijalankan apabila pengguna menekan button keluar
    function keluar()
    {
        // menghapus cookie yang sudah dibuat pada saat daftar/masuk
        Cookie::expire('accessToken');
        Cookie::expire('idUser');
        Cookie::expire('profileUser');
        Cookie::expire('roleUser');

        return redirect()->route('home');
    }
}
