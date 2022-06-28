<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminDataProdukController extends Controller
{
    function index()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/dataproduct';

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $data = json_decode(Cookie::get('profileUser'), true);
            Log::info($response);

            return view('admin/admin_data_produk')->with([
                'data' => $response,
                'dataProfile' => $data,
                'title' => "Data Produk"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function hapusProduk($id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/deleteproduct/' . $id;

        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        try {
            $client->delete($URI, $params);
            return redirect()->route('adminDataProdukView')->with('success', 'Data Produk berhasil dihapus!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function indexEditProduk($id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/dataproduct/' . $id;

        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $data = json_decode(Cookie::get('profileUser'), true);

            Log::info($response);

            return view('admin/admin_edit_produk')->with([
                'dataProduk' => $response,
                'dataProfile' => $data,
                'title' => "Edit Produk"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function simpanEditProduk(Request $request, $id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/updateproduct/' . $id;

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

        $file = $request->file('image');
        Log::info($file);

        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

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
            $action = $client->put($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            Log::info($response);

            return redirect()->route('adminDataProdukView')->with('success', 'Data produk berhasil diubah!');
        } catch (ServerException $e) {
            Log::error($e);
            $responseError = $e->getResponse();
            $responseErrorBodyAsString = $responseError->getBody()->getContents();

            return redirect()->route('adminFormTambahProdukView')->withErrors([$responseErrorBodyAsString]);
        }
    }
}
