<?php

namespace App\Http\Controllers\Admin;

// controller untuk halaman form tambah produk
use App\Http\Controllers\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminFormTambahProdukController extends Controller
{
    // fungsi untuk menampilkan halaman form tambah produk
    function index()
    {
        $data = json_decode(Cookie::get('profileUser'), true);

        // diarahkan ke halaman form tambah produk dengan data berikut
        return view('admin/admin_form_tambah_produk')->with([
            'dataProfile' => $data,
            'title' => "Form Tambah Produk",
        ]);
    }

    // fungsi yang dijalankan ketika admin menyimpan data produk baru pada form
    function tambahProduk(Request $request)
    {
        // API untuk menambah produk 
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/addproduct';

        // validasi inputan
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

        // token yang dibutuhkan untuk menjalankan fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        // data yang dibutuhkan untuk dikirim ke database untuk menambah produk baru
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
            // mengirimkan data produk baru ke database lewat API
            $action = $client->post($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            // diarahkan kembali ke halaman data produk dengan pesan success jika berhasil
            return redirect()->route('adminDataProdukView')->with('success', 'Produk berhasil ditambahkan!');
        } catch (ServerException $e) {
            Log::error($e);
            $responseError = $e->getResponse();
            $responseErrorBodyAsString = $responseError->getBody()->getContents();

            return redirect()->route('adminFormTambahProdukView')->withErrors([$responseErrorBodyAsString]);
        }
    }
}
