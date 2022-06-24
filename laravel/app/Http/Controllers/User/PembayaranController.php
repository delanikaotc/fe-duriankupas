<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

// use Google\Cloud\Firestore\FirestoreClient;


class PembayaranController extends Controller
{
    function index($id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/mytransaction/' . cookie::get('idUser');

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );
        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);
            $data = json_decode(Cookie::get('profileUser'), true);

            $i = 0;
            $x = [];

            foreach ($response as $pesanan) {
                if ($pesanan['_id'] == $id) {
                    $arrPesanan = $pesanan;
                    return view('user/user_pembayaran')->with([
                        'dataPesanan' => $arrPesanan,
                        'data' => $data,
                        'title' => "Pembayaran"
                    ]);
                    $i++;
                }
            }
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function uploadBuktiPembayaran(Request $request, $id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/payment/' . $id;

        $request->validate([
            'image' => ['required'], ['mimes:jpeg,jpg,png'],
        ], [
            'image.required' => 'Kamu harus menambahkan gambar bukti!',
            'image.mimes' => 'Gambar harus jpeg, jpg, atau png!'
        ]);

        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        $file = $request->file('image');

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

            return redirect()->route('userPesananView')->with('success', 'Unggah bukti pembayaran kamu berhasil!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
