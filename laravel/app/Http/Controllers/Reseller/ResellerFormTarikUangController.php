<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;

// controller untuk halaman form tarik uang 
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ResellerFormTarikUangController extends Controller
{
    // fungsi untuk menampilkan halaman form tarik uang
    function index()
    {
        $data = json_decode(Cookie::get('profileUser'), true);

        // diarahkan ke halaman form tarik uang dengan data berikut 
        return view('reseller/reseller_form_tarik_uang', [
            'dataProfile' => $data,
            'title' => "Form Pengajuan Tarik Uang"
        ]);
    }

    // fungsi yang dijalankan ketika reseller menekan button ajukan penarikan
    function ajukanPenarikan(Request $request)
    {
        // URI API untuk mengirimkan data ke database
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/reseller/tarikuang';

        // validasi inputan jumlah yang diinput oleh reseller
        $request->validate([
            'jumlah' => ['required', 'numeric'],
        ], [
            'jumlah.required' => 'Kamu harus mengisi jumlah saldo yang ingin diajukan!',
            'jumlah.numeric' => 'Jumlah harus berisi angka saja!'
        ]);

        // token untuk menjalankan fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        // data yang dibutuhkan untuk dikirimkan ke database pengajuan tarik uang
        $params['form_params'] = array(
            'jumlah' => $request->jumlah
        );

        try {
            // mengirimkan data yang diinput dari fe ke database lewat API
            $action = $client->post($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            // diarahkan ke halaman data penarikan uang dengan pesan sukses
            return redirect()->route('resellerDataTarikUangView')->with('success', 'Pengajuan tarik uang berhasil diajukan!');
        } catch (ServerException $e) {
            Log::error($e);
            // mengambil response error dari be apabila nominalnya tidak sesuai
            $responseError = $e->getResponse();
            $responseErrorBodyAsString = $responseError->getBody()->getContents();

            return redirect()->route('resellerFormTarikUangView')->withErrors([$responseErrorBodyAsString]);
        }
    }
}
