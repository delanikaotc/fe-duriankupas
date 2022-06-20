<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ResellerFormRestockController extends Controller
{
    function index()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users';

        try {
            $action = $client->get($URI);
            $response = json_decode($action->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            return view('reseller/reseller_form_restock', [
                'dataProduk' => $response,
                'dataProfile' => $data,
                'title' => "Form Restock"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function ajukanRestock(Request $request)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/reseller/restock';

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        $input = $request->all();
        $semuaProduk = [];

        foreach ($input['ArrRequest'] as $i) {
            if ($i['jumlah'] > 0 && $i['jumlah'] != null) {
                array_push($semuaProduk, $i);
            }
        }

        $params['form_params'] = array(
            'product' => $semuaProduk
        );
        Log::info($semuaProduk);

        try {
            if (!empty($semuaProduk)) {
                $action = $client->post($URI, $params);
                $response = json_decode($action->getBody()->getContents(), true);

                Log::info($response);

                $data = json_decode(Cookie::get('profileUser'), true);

                return redirect()->route('resellerDataRestockView')->with('success', 'Permohonan restock berhasil diajukan!');
            }
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->withErrors(['Masukkan jumlah!']);
        }
    }
}
