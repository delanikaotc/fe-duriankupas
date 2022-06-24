<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ResellerFormTarikUangController extends Controller
{
    function index()
    {
        $data = json_decode(Cookie::get('profileUser'), true);

        return view('reseller/reseller_form_tarik_uang', [
            'dataProfile' => $data,
            'title' => "Form Pengajuan Tarik Uang"
        ]);
    }

    function ajukanPenarikan(Request $request)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/reseller/tarikuang';

        $request->validate([
            'jumlah' => ['required', 'numeric'],
        ], [
            'jumlah.required' => 'Kamu harus mengisi jumlah saldo yang ingin diajukan!',
            'jumlah.numeric' => 'Jumlah harus berisi angka saja!'
        ]);

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        $params['form_params'] = array(
            'jumlah' => $request->jumlah
        );

        try {
            $action = $client->post($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            return redirect()->route('resellerDataTarikUangView')->with('success', 'Pengajuan tarik uang berhasil diajukan!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
