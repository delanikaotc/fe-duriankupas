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

        $request->validate([
            'nama' => ['required', 'max:30'],
            'harga' => ['required', 'numeric'],
            'deskripsi' => ['max:50'],
            'image' => ['required', 'mimes:jpeg,jpg,png'],
        ], [
            'nama.required' => 'Kamu harus mengisi Nama Produk!',
            'nama.max' => 'Username maksimal 30 karakter!',
            'harga.required' => 'Kamu harus mengisi Harga Produk!',
            'harga.numeric' => 'Harga harus angka!',
            'deskripsi.max' => 'Kata Sandi maksimal 50 karakter!',
            'image.required' => 'Kamu harus menambahkan Gambar Produk!',
            'image.mimes' => 'Gambar harus .jpeg, .jpg, atau .png',
        ]);

        $file = $request->file('image');


        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        // $params['form_params'] = array();

        $params['multipart'] = array(
            [
                'name' => 'image',
                'contents' => file_get_contents($file->getPathname()),
                'filename' => $file->getClientOriginalName()
            ],
            [
                'name' => 'nama',
                'contents' => $request->nama
            ],
            [

                'name' => 'harga',
                'contents' => $request->harga
            ],
            [

                'name' => 'deskripsi',
                'contents' => $request->deskripsi
            ]
        );

        try {
            $action = $client->post($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            Log::info($response);

            return redirect()->route('adminDataProdukView')->with('success', 'Produk berhasil ditambahkan!');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->route('adminFormTambahProdukView')->withErrors($e->getMessage());
        }
    }
}
