<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class BeriUlasanController extends Controller
{
    function index($id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/transaksi/' . $id;

        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        $data = json_decode(Cookie::get('profileUser'), true);

        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            return view('user/user_beri_ulasan')->with([
                'dataProfile' => $data,
                'data' => $response,
                'title' => "Beri Ulasan"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function kirimUlasan(Request $request, $id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/rating/' . $id;

        $request->validate([
            'rating' => ['required', 'numeric'],
            'review' => ['required', 'max:255'],
        ], [
            'rating.required' => 'Kamu harus mengisi Rating!',
            'rating.numeric' => 'Rating harus angka!',
            'review.required' => 'Kamu harus mengisi Ulasan!',
            'review.max' => 'Ulasan maksimal 255 karakter!',
        ]);

        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        $params['form_params'] = array(
            'rating' => $request->rating,
            'review' => $request->review
        );

        Log::info($params['form_params']);

        try {
            $action = $client->post($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            return redirect()->route('userPesananView')->with('success', 'Ulasan berhasil ditambahkan!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
