<?php

namespace App\Http\Controllers;

// controller untuk menampilkan halaman bantuan
use Exception;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class BantuanController extends Controller
{
    function index()
    {
        // menggunakan try catch agar tidak langsung berhenti ketika menemukan error
        try {
            // data profile user 
            $data = json_decode(Cookie::get('profileUser'), true);

            // return view apabila berhasil
            return view('bantuan', [
                'data' => $data,
                'title' => "Bantuan"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
