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

        $request->validate([
            'namatoko' => ['required'],
            'username' => ['required'],
            'provinsi' => ['required'],
            'kota' => ['required']

        ], [
            'namatoko.required' => 'Kamu harus mengisi Nama Toko!',
            'username.required' => 'Kamu harus mengisi Username!',
            'provinsi.required' => 'Kamu harus mengisi Provinsi!',
            'kota.required' => 'Kamu harus mengisi Kota!',
        ]);

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
            'username' => $request->username,
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

                return redirect()->route('adminDataResellerView')->with('success', 'Reseller berhasil ditambahkan!');
            }
            return redirect()->route('adminFormTambahResellerView')->withErrors(['Masukkan jumlah dengan benar!']);
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->route('adminFormTambahResellerView')->withErrors([$e->getMessage()]);
        }
    }
}
