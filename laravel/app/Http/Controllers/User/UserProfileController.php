<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

// controller untul halaman profil user dan ubah profil user
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class UserProfileController extends Controller
{
    // fungsi untuk menangani data yang diperlukan pada halaman profil user
    function index()
    {
        // URI API get data user by id 
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/profile/' . cookie::get('idUser');

        // membutuhkan token untuk mengakses fungsi ini
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            // get data user by id lewat URI yang diberikan
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            // jika berhasil, diarahkan ke halaman profil user dengan data berikut
            return view('user/user_home')->with([
                'data' => $response,
                'title' => "Profil"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang menangani data yang diperlukan untuk tampilan edit profil
    function editProfil($id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/profile/' . $id;

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            return view('user/user_edit_profil')->with([
                'data' => $response,
                'title' => "Edit Profil"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function simpanEditProfil(Request $request, $id)
    {
        // URI API get data user by id 
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/update/' . $id;

        // validasi request yang masuk untuk data yang diberikan
        $request->validate([
            'phone' => ['required', 'numeric', 'digits_between:10,15'],
            'tangallahir' => ['date']
        ], [
            'phone.required' => 'Kamu harus mengisi Nomor Telepon!',
            'phone.numeric' => 'Nomor telepon harus angka!',
            'phone.digits_between' => 'Nomor telepon harus 10 s.d 15 digit!',
            'tanggallahir.date' => 'Tanggal lahir harus berupa tanggal!'
        ]);

        // fungsi ini membutuhkan token
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        // data yang akan diberikan ke database lewat API
        $params['form_params'] = array(
            'phone' => $request->phone,
            'jeniskelamin' => $request->jeniskelamin,
            'tanggallahir' => $request->tanggallahir,
        );

        try {
            // mengirim data untuk diubah ke database lewat URI
            $action = $client->put($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            // jika berhasil akan diarahkan ke profil dengan message sukses
            return redirect()->route('userProfileView')->with('success', 'Data berhasil diubah!');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->route('userProfileView')->withErrors([$e->getMessage()]);
        }
    }
}
