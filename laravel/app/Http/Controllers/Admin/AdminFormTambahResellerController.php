<?php

namespace App\Http\Controllers\Admin;

// controller untuk halaman form tambah reseller
use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminFormTambahResellerController extends Controller
{
    // fungsi untuk menampilkan halaman form tambah reseller
    function index()
    {
        // API untuk mendapatkan data produk yang akan ditampilkan
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users';

        try {
            // mendapatkan data produk dari database lewat API
            $action = $client->get($URI);
            $response = json_decode($action->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            // diarahkan ke form tambah reseller apabila berhasil dengan data berikut
            return view('admin/admin_form_tambah_reseller')->with([
                'dataProduk' => $response,
                'dataProfile' => $data,
                'title' => "Form Tambah Reseller"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang dijalankan jika admin menekan button tambahreseller pada form tambah reseller
    function tambahReseller(Request $request)
    {
        // API untuk menambahkan toko 
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/addtoko';

        // validasi inputan dari front end
        $request->validate([
            'namatoko' => ['required'],
            'username' => ['required'],
            'provinsi' => ['required'],
            'kota' => ['required']

        ], [
            'namatoko.required' => 'Kamu harus mengisi Nama Toko!',
            'username.required' => 'Kamu harus mengisi Username!',
            'provinsi.required' => 'Kamu harus mengisi Provinsi!',
            'kota.required' => 'Kamu harus mengisi Kota!',
        ]);

        // token yang dibutuhkan untuk menjalankan fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        // fungsi seperti membuat pesanan 
        $input = $request->all();
        Log::info($input);
        $semuaProduk = [];

        foreach ($input['ArrStock'] as $i) {
            if ($i['jumlah'] > 0 && $i['jumlah'] != null) {
                array_push($semuaProduk, $i);
            }
        }

        // data yang dibutuhkan untuk dikirimkan ke database tambah reseller
        $params['form_params'] = array(
            'namatoko' => $request->namatoko,
            'username' => $request->username,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'stock' => $semuaProduk
        );

        try {
            // jika data semuaproduk tidak kosong maka jalankan fungsi dibawahnya
            if (!empty($semuaProduk)) {
                // mengirimkan data reseller baru ke database lewat API
                $action = $client->post($URI, $params);

                // diarahkan kembali ke halaman data reseller dengan pesan success
                return redirect()->route('adminDataResellerView')->with('success', 'Reseller berhasil ditambahkan!');
            }
            return redirect()->route('adminFormTambahResellerView')->withErrors(['Masukkan jumlah dengan benar!']);
        } catch (ServerException $e) {
            Log::error($e);
            $responseError = $e->getResponse();
            $responseErrorBodyAsString = $responseError->getBody()->getContents();

            return redirect()->route('adminFormTambahResellerView')->withErrors([$responseErrorBodyAsString]);
        }
    }
}
