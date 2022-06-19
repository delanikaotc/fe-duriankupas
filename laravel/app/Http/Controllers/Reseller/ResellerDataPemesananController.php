<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ResellerDataPemesananController extends Controller
{
    function indexPemesananBaru()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/reseller/datapesanan';

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            return view('reseller/reseller_data_pemesanan_baru')->with([
                'data' => $response,
                'title' => "Data Pemesanan"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function indexRiwayatPemesanan()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/reseller/datapesanan';

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            return view('reseller/reseller_data_pemesanan_lama')->with([
                'data' => $response,
                'title' => "Data Pemesanan"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
