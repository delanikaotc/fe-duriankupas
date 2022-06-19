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
    function index()
    {
        $data = json_decode(Cookie::get('profileUser'), true);

        return view('user/user_beri_ulasan')->with([
            'data' => $data,
            'title' => "Beri Ulasan"
        ]);
    }

    function kirimUlasan(Request $request, $id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/rating/' . $id;

        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        $params['form_params'] = array(
            'rating' => $request->rating,
            'review' => $request->review
        );


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
