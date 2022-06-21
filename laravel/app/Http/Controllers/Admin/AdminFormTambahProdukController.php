<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminFormTambahProdukController extends Controller
{
    function index()
    {
        $data = json_decode(Cookie::get('profileUser'), true);

        return view('admin/admin_form_tambah_produk')->with([
            'dataProfile' => $data,
            'title' => "Form Tambah Produk",
        ]);
    }

    function tambahProduk(Request $request)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/addproduct';

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        $params['form_params'] = array(
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'img' => $request->img
        );

        try {
            $action = $client->post($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            Log::info($response);

            return redirect()->route('adminDataProdukView')->with('success', 'Produk berhasil ditambahkan!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
