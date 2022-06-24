<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminFormUploadBuktiController extends Controller
{
    function index($id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/datatarikuang/' . $id;

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            return view('admin/admin_form_upload_bukti')->with([
                'dataTarikUang' => $response,
                'dataProfile' => $data,
                'title' => "Form Upload Bukti"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function uploadBukti(Request $request, $id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/transfer/' . $id;

        $file = $request->file('image');

        $request->validate([
            'image' => ['required', 'mimes:jpeg,jpg,png'],
        ], [
            'image.required' => 'Kamu harus menambahkan Gambar Bukti!',
            'image.mimes' => 'Gambar harus .jpeg, .jpg, atau .png',
        ]);

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        $params['multipart'] = array(
            [
                'name' => 'image',
                'contents' => file_get_contents($file->getPathname()),
                'filename' => $file->getClientOriginalName()
            ]
        );

        try {
            $action = $client->put($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            Log::info($response);

            return redirect()->route('adminDataTarikUangView')->with('success', 'Bukti berhasil diunggah!');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->route('adminDataTarikUangView')->withErrors(['Gagal mengunggah bukti!']);
        }
    }
}
