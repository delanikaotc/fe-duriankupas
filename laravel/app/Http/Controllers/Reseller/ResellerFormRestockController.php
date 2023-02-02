<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;

// controller untuk form restock controller
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ResellerFormRestockController extends Controller
{
    // fungsi untuk menampilkan tampilan form restock ketika reseller menekan button ajukan request restock
    function index()
    {
        // URI API untuk get data produk
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/users';

        try {
            // mengambil data produk dari database lewat API
            $action = $client->get($URI);
            $response = json_decode($action->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            // diarahkan ke halaman form restock jika berhasil dengan data berikut
            return view('reseller/reseller_form_restock', [
                'dataProduk' => $response,
                'dataProfile' => $data,
                'title' => "Form Restock"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang akan dijalankan apabila reseller memencet button kirim pada halaman form request restock
    function ajukanRestock(Request $request)
    {
        // URI API untuk data restock
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/reseller/restock';

        // token yang dibutuhkan
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        // kurang lebih proses yang sama dengan memesan produk pada controller produk kami
        $input = $request->all();
        $semuaProduk = [];

        foreach ($input['ArrRequest'] as $i) {
            if ($i['jumlah'] > 0 && $i['jumlah'] != null) {
                array_push($semuaProduk, $i);
            }
        }

        // data yang dibutuhkan untuk dikirimkan ke database
        $params['form_params'] = array(
            'product' => $semuaProduk
        );

        try {
            // jika data restock tidak kosong
            if (!empty($semuaProduk)) {
                // jalankan kirim data restock ke database
                $action = $client->post($URI, $params);
                $response = json_decode($action->getBody()->getContents(), true);

                // jika berhasil, arahkan ke halaman 
                return redirect()->route('resellerDataRestockView')->with('success', 'Permohonan restock berhasil diajukan!');
            }
        } catch (Exception $e) {
            Log::error($e);
            // jika terdapat error tentang jumlah, akan diarahkan kembali dengan error message
            return redirect()->back()->withErrors(['Masukkan jumlah dengan benar!']);
        }
        return redirect()->route('resellerFormRestockView')->withErrors(['Masukkan jumlah dengan benar!']);
    }
}
