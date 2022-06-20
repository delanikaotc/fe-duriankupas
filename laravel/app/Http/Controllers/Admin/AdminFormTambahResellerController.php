<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminFormTambahResellerController extends Controller
{
    function index()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users';

        try {
            $action = $client->get($URI);
            $response = json_decode($action->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            return view('admin/admin_form_tambah_reseller')->with([
                'dataProduk' => $response,
                'dataProfile' => $data,
                'title' => "Form Tambah Reseller"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function tambahReseller(Request $request)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/addtoko';

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        $input = $request->all();
        Log::info($input);
        $semuaProduk = [];

        foreach ($input['ArrStock'] as $i) {
            if ($i['jumlah'] > 0 && $i['jumlah'] != null) {
                array_push($semuaProduk, $i);
            }
        }

        $params['form_params'] = array(
            'namatoko' => $request->namatoko,
            'id_user' => $request->id_user,
            'email' => $request->email,
            'phone' => $request->phone,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'stock' => $semuaProduk
        );
        Log::info($semuaProduk);

        try {
            if (!empty($semuaProduk)) {
                $action = $client->post($URI, $params);
                $response = json_decode($action->getBody()->getContents(), true);

                Log::info($response);

                $data = json_decode(Cookie::get('profileUser'), true);

                return redirect()->route('adminDataResellerView')->with('success', 'Reseller berhasil ditambahkan!');
            }
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->withErrors(['Masukkan jumlah!']);
        }
    }
}
