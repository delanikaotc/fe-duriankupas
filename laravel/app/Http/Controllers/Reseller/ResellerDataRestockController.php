<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ResellerDataRestockController extends Controller
{
    function index()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/reseller/datarestock';

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            $data = json_decode(Cookie::get('profileUser'), true);


            return view('reseller/reseller_data_restock')->with([
                'dataProfile' => $data,
                'data' => $response,
                'title' => "Data Restock"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
