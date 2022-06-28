<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use FFI\Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminDataUlasanController extends Controller
{
    function index()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/review';
        $URIPesanan = 'https://beduriankupas.herokuapp.com/api/admin/datapesanan';

        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $actionPesanan = $client->get($URIPesanan, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $responsePesanan = json_decode($actionPesanan->getBody()->getContents(), true);

            Log::info($response);
            Log::info($responsePesanan);

            $data = json_decode(Cookie::get('profileUser'), true);

            return view('admin/admin_data_ulasan')->with([
                'data' => $response,
                'dataPesanan' => $responsePesanan,
                'dataProfile' => $data,
                'title' => "Ulasan Pesanan"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
