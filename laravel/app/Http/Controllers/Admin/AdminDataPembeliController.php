<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use FFI\Exception;
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

        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            return view('admin/admin_data_pembeli')->with([
                'data' => $response,
                'title' => "Data Pembeli"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function hapusPembeli($id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/deletePembeli/' . $id;

        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        try {
            $client->delete($URI, $params);
            return redirect()->route('adminDataPembeliView')->with('success', 'Data Pembeli berhasil dihapus!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
