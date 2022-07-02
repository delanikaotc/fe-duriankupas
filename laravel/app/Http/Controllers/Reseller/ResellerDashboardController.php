<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;

// controller untuk halaman dashboard reseller
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ResellerDashboardController extends Controller
{
    // fungsi untuk menampilkan halaman dashboard reseller
    function index()
    {
        // URI API untuk get data reseller
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/reseller/';


        // token yang dibutuhkan untuk akses fungsi ini
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            // mengambil data dari database menggunakan link API 
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            // jika berhasil mengarahkan ke halaman dashboard reseller dengan data berikut
            return view('reseller/reseller_home')->with([
                'dataProfile' => $data,
                'data' => $response,
                'title' => "Dashboard"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
