<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminDataPemesananController extends Controller 
{
    function index()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/datapesanan';

        $params['headers'] = array (
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try{
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            return view('admin/admin_data_pemesanan')->with([
                'data' => $response,
                'title' =>"Data Pemesanan"
            ]);
        }
        catch (Exception $e){
            Log::error($e);
        }
    }


}