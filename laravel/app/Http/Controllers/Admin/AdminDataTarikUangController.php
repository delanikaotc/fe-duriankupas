<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminDataTarikUangController extends Controller
{
    function index()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/datatarikuang';
        $URIReseller = 'https://beduriankupas.herokuapp.com/api/admin/datareseller';


        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $actionReseller = $client->get($URIReseller, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $responseReseller = json_decode($actionReseller->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            Log::info($response);
            Log::info($responseReseller);

            return view('admin/admin_data_tarik_uang')->with([
                'data' => $response,
                'dataReseller' => $responseReseller,
                'dataProfile' => $data,
                'title' => "Data Tarik Uang"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // function terimaBuktiPembayaran($id)
    // {
    //     $client = new Client();
    //     $URI = 'https://beduriankupas.herokuapp.com/api/admin/pembayaranterverifikasi/' . $id;

    //     $params['headers'] = array(
    //         'token' => 'Bearer ' . cookie::get('accessToken'),
    //     );
    //     try {
    //         $client->put($URI, $params);
    //         return redirect()->route('adminDataPemesananView')->with('success', 'Pembayaran berhasil terverifikasi!');
    //     } catch (Exception $e) {

    //         Log::error($e);
    //     }
    // }
}
