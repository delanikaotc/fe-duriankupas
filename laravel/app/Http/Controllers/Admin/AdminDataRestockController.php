<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminDataRestockController extends Controller
{
    function index()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/datarestock';
        $URIReseller = 'https://beduriankupas.herokuapp.com/api/admin/datareseller';

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $actionReseller = $client->get($URIReseller, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $responseReseller = json_decode($actionReseller->getBody()->getContents(), true);
            Log::info($response);
            Log::info($responseReseller);

            $data = json_decode(Cookie::get('profileUser'), true);


            return view('admin/admin_data_restock')->with([
                'dataReseller' => $responseReseller,
                'dataProfile' => $data,
                'data' => $response,
                'title' => "Data Restock"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function kirimRestock($id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/restockdikirim/' . $id;

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );
        try {
            $client->put($URI, $params);
            return redirect()->route('adminDataRestockView')->with('success', 'Restock sudah dikirim!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
