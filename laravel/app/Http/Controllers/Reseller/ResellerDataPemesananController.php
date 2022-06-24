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

            $data = json_decode(Cookie::get('profileUser'), true);


            return view('reseller/reseller_data_pemesanan_baru')->with([
                'dataProfile' => $data,
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

            $data = json_decode(Cookie::get('profileUser'), true);

            return view('reseller/reseller_data_pemesanan_lama')->with([
                'dataProfile' => $data,
                'data' => $response,
                'title' => "Data Pemesanan"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function barangDikirim($id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/reseller/dikirim/' . $id;

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            $client->put($URI, $params);
            return redirect()->route('resellerDataPemesananBaruView')->with('success', 'Barang berhasil dikirim!');
        } catch (Exception $e) {

            Log::error($e);
        }
    }
}
