<?php

namespace App\Http\Controllers\Reseller;
use App\Http\Controllers\Controller;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ResellerDashboardController extends Controller 
{
    function index()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/reseller/';

        $params['headers'] = array (
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try{
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            return view('reseller/reseller_home')->with([
                'data' => $response,
                'title' =>"Dashboard"
            ]);
        }
        catch (Exception $e){
            Log::error($e);
        }
    }


}