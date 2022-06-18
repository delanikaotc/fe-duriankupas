<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminDataResellerController extends Controller 
{
    function index()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/datareseller';

        $params['headers'] = array (
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try{
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            return view('admin/admin_data_reseller')->with([
                'data' => $response,
                'title' =>"Data Reseller"
            ]);
        }
        catch (Exception $e){
            Log::error($e);
        }
    }


}