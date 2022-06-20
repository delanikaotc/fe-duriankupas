<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ResellerDataTarikUangController extends Controller
{
    function index()
    {
        // $client = new Client();
        // $URI = 'https://beduriankupas.herokuapp.com/api/reseller/datarestock';

        // $params['headers'] = array(
        //     'token' => 'Bearer ' . cookie::get('accessToken'),
        // );

        // try {
        //     $action = $client->get($URI, $params);
        //     $response = json_decode($action->getBody()->getContents(), true);
        //     Log::info($response);

        $data = json_decode(Cookie::get('profileUser'), true);


        return view('reseller/reseller_data_tarik_uang')->with([
            'dataProfile' => $data,
            // 'data' => $response,
            'title' => "Data Tarik Uang"
        ]);
        // } catch (Exception $e) {
        //     Log::error($e);
        // }
    }
}
