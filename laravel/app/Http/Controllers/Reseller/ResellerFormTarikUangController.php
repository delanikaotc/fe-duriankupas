<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ResellerFormTarikUangController extends Controller
{
    function index()
    {
        // $client = new Client();
        // $URI = 'https://beduriankupas.herokuapp.com/api/users';

        // try {
        //     $action = $client->get($URI);
        //     $response = json_decode($action->getBody()->getContents(), true);

        $data = json_decode(Cookie::get('profileUser'), true);

        return view('reseller/reseller_form_tarik_uang', [
            // 'dataProduk' => $response,
            'dataProfile' => $data,
            'title' => "Form Restock"
        ]);
        // } catch (Exception $e) {
        //     Log::error($e);
        // }
    }
}
