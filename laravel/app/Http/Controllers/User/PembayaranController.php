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

        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        $params['form_params'] = array(
            'buktipembayaran' => $request->buktipembayaran
        );

        try {
            $action = $client->put($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            info($response);

            $data = json_decode(Cookie::get('profileUser'), true);

            return redirect()->route('userPesananView')->with('success', 'Pemnbayaran kamu diterima!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }
    // function uploadBuktiPembayaran(Request $request)
    // {
    //     $image = $request->file('buktipembayaran');

    //     $student = app('firebase.firestore')->database()->collection('buktiPembayaran')->document

    //     try {
    //         $action = $client->get($URI);
    //         $response = json_decode($action->getBody()->getContents(), true);
    //         Log::info($response);

    //         $data = json_decode(Cookie::get('profileUser'), true);

    //         return view('produk', [
    //             'dataProduk' => $response,
    //             'data' => $data,
    //             'title' => "Produk Kami"
    //         ]);
    //     } catch (Exception $e) {
    //         Log::error($e);
    //     }
    // }
}
