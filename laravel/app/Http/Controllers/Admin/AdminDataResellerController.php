<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Exception;
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

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $data = json_decode(Cookie::get('profileUser'), true);
            Log::info($response);

            return view('admin/admin_data_reseller')->with([
                'data' => $response,
                'dataProfile' => $data,
                'title' => "Data Reseller"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function hapusReseller($id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/deletetoko/' . $id;

        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        try {
            $client->delete($URI, $params);
            return redirect()->route('adminDataResellerView')->with('success', 'Data Reseller berhasil dihapus!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function editReseller($id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/datareseller/' . $id;

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $data = json_decode(Cookie::get('profileUser'), true);
            Log::info($response);

            return view('admin/admin_edit_reseller')->with([
                'data' => $response,
                'dataProfile' => $data,
                'title' => "Edit Profil"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function simpanEditReseller(Request $request, $id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/updatetoko/' . $id;

        $request->validate([
            'namatoko' => ['required'],
            'phone' => ['required', 'numeric', 'digits_between:10,15']
        ], [
            'namatoko.required' => 'Kamu harus mengisi Nama Toko!',
            'phone.required' => 'Kamu harus mengisi Nomor Telepon!',
            'phone.numeric' => 'Nomor telepon harus angka!',
            'phone.digits_between' => 'Nomor telepon harus 10 s.d 15 digit!',
        ]);

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        $params['form_params'] = array(
            'namatoko' => $request->namatoko,
            'phone' => $request->phone,
        );

        try {
            $action = $client->put($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            return redirect()->route('adminDataResellerView')->with('success', 'Data Reseller berhasil diubah!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
