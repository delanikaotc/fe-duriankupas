<?php

namespace App\Http\Controllers;

// controller untuk mengatur passing data daftar dari front-end ke back-end 
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\ServerException;

class DaftarController extends Controller
{
    // fungsi untuk menampilkan tampilan daftar
    function index()
    {
        // mengakses file view daftar dan memberi judul halaman
        return view('daftar', ["title" => "Daftar"]);
    }

    // fungsi untuk daftar 
    function daftar(Request $request)
    {
        // URI API untuk post data daftar ke database
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/auth/register';

        //fungsi validasi untuk username, email, password, dan nomor telepon
        $request->validate([
            'username' => ['required', 'min:6', 'max:30'],
            'email' => ['required'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8'],
            'phone' => ['required', 'numeric', 'digits_between:10,15'],
        ], [
            'username.required' => 'Kamu harus mengisi Username!',
            'username.min' => 'Username minimal 6 karakter!',
            'username.max' => 'Username maksimal 30 karakter!',
            'email.required' => 'Kamu harus mengisi Email!',
            'password.required' => 'Kamu harus mengisi Kata Sandi!',
            'password.min' => 'Kata Sandi minimal 8 karakter!',
            'password.confirmed' => 'Kata Sandi tidak sama!',
            'password_confirmation.required' => 'Kamu harus mengetik ulang Kata Sandi!',
            'password_confirmation.min' => 'Kata Sandi minimal 8 karakter!',
            'phone.required' => 'Kamu harus mengisi Nomor Telepon!',
            'phone.digits_between' => 'Nomor Telepon harus 10 s.d. 15 angka!',
            'phone.numeric' => 'Nomor Telepon harus angka!',
        ]);

        // data yang dibutuhkan untuk dipassing ke database, diambil dari request front end
        $params['form_params'] = array(
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone
        );

        // menggunakan try catch agar program tidak langsung stop ketika error
        try {
            //post data daftar
            $action = $client->post($URI, $params);
            $responseJson = $action->getBody();
            $response = json_decode($responseJson, true);

            // membuat cookie yang akan digunakan selama menggunakan website
            $profile = cookie('profileUser', $responseJson, 60);
            $idUser = cookie('idUser', $response['savedUser']['_id'], 60);
            $roleUser = cookie('roleUser', $response['savedUser']['role'], 60);
            $tokenCookie = cookie('accessToken', $response['accessToken'], 60);

            // mengarahkan ke profil user apabila berhasil daftar dengan cookie yang sudah dibuat
            return redirect()->route('userProfileView')->withCookies([$tokenCookie, $idUser, $profile, $roleUser]);
        } catch (ServerException $e) {
            Log::error($e);

            // mengambil response error dari API dan menampilkan alert pada front-end
            $responseError = $e->getResponse();
            $responseErrorBodyAsString = $responseError->getBody()->getContents();

            return redirect()->route('daftarView')->withErrors([$responseErrorBodyAsString]);
        }
    }
}
