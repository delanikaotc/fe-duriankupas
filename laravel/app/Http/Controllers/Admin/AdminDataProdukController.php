<?php

namespace App\Http\Controllers\Admin;

// controller untuk halaman data produk
use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminDataProdukController extends Controller
{
    // fungsi untuk menampilkan halaman data produk
    function index()
    {
        // API untuk mendapatkan data produk
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/admin/dataproduct';

        // token yang dibutuhkan untuk mengakses
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            // mengambil data produk dari database lewat API
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $data = json_decode(Cookie::get('profileUser'), true);

            // diarahkan ke halaman data produk jika berhasil dengan data berikut
            return view('admin/admin_data_produk')->with([
                'data' => $response,
                'dataProfile' => $data,
                'title' => "Data Produk"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang dijalankan apabila admin menghapus produk dengan id produk 
    function hapusProduk($id)
    {
        // API untuk menghapus produk dengan id produk
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/admin/deleteproduct/' . $id;

        // token yang dibutuhkan untuk menjalankan fungsi 
        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        try {
            // menghapus produk dari database lewat API
            $client->delete($URI, $params);
            // diarahkan ke data produk kembali dengan pesan success
            return redirect()->route('adminDataProdukView')->with('success', 'Data Produk berhasil dihapus!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi untuk menampilkan halaman ubah data produk
    function indexEditProduk($id)
    {
        // API untuk mendapatkan data spesifik produk dari id 
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/admin/dataproduct/' . $id;

        // token yang dibutuhkan untuk menjalankan fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        try {
            // mendapatkan data produk berdasarkan id dari database lewat API
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $data = json_decode(Cookie::get('profileUser'), true);

            // diarahkan ke halaman ubah data produk dengan data berikut jika berhasil
            return view('admin/admin_edit_produk')->with([
                'dataProduk' => $response,
                'dataProfile' => $data,
                'title' => "Edit Produk"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang dijalankan jika admin menyimpan data perubahan produk yang disubmit
    function simpanEditProduk(Request $request, $id)
    {
        // API untuk mengubah data produk
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/admin/updateproduct/' . $id;

        // validasi inputan dari front end
        $request->validate([
            'nama' => ['required', 'max:30'],
            'harga' => ['required', 'numeric'],
            'deskripsi' => ['max:50'],
            'image' => ['mimes:jpeg,jpg,png'],
        ], [
            'nama.required' => 'Kamu harus mengisi Nama Produk!',
            'nama.max' => 'Username maksimal 30 karakter!',
            'harga.required' => 'Kamu harus mengisi Harga Produk!',
            'harga.numeric' => 'Harga harus angka!',
            'deskripsi.max' => 'Kata Sandi maksimal 50 karakter!',
            'image.mimes' => 'Gambar harus .jpeg, .jpg, atau .png',
        ]);

        // membuat variabel untuk image
        $file = $request->file('image');

        // token untuk akses fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        // jika gambar tidak diupdate maka tetap bisa update untuk data yang lain
        if (!empty($file)) {
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
        } else {
            $params['multipart'] = array(
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
        }

        try {
            // mengedit data produk di database lewat API
            $action = $client->put($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            // diarahkan ke halaman data produk kembali dengan pesan success 
            return redirect()->route('adminDataProdukView')->with('success', 'Data produk berhasil diubah!');
        } catch (ServerException $e) {
            Log::error($e);
            $responseError = $e->getResponse();
            $responseErrorBodyAsString = $responseError->getBody()->getContents();

            return redirect()->route('adminFormTambahProdukView')->withErrors([$responseErrorBodyAsString]);
        }
    }
}
