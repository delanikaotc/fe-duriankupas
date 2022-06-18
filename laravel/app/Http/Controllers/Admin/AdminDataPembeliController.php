<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminDataPembeliController extends Controller 
{
    function index()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/dataPembeli';

        $params['headers'] = array (
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try{
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            return view('admin/admin_data_pembeli')->with([
                'data' => $response,
                'title' =>"Data Pembeli"
            ]);
        }
        catch (Exception $e){
            Log::error($e);
        }
    }

    function hapusPembeli ($id)
    {
        $client = new Client ();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/deletetoko/'. $id;

        $params['headers'] = array (
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try{
            $action = $client->delete($URI, $params);
            // $response = json_decode($action->getBody()->getContents(), true);
            // Log::info($response);
            return redirect()->route('adminDataPembeliView')->with('success', 'Data Pembeli berhasil dihapus!');
        }
        catch (Exception $e){
            Log::error($e);
        }
    }
}