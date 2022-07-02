<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// controller untuk halaman data reseller dan ubah data reseller
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminDataResellerController extends Controller
{
    // fungsi untuk menampilkan halaman data reseller
    function index()
    {
        // API untuk mengambil data semua reseller
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/datareseller';

        // token yang dibutuhkan
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            // mengambil data semua reseller dari database lewat API
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $data = json_decode(Cookie::get('profileUser'), true);

            // diarahkan ke halaman data reseller dengan data berikut jika berhasil
            return view('admin/admin_data_reseller')->with([
                'data' => $response,
                'dataProfile' => $data,
                'title' => "Data Reseller"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang dijalankan jika admin menghapus data reseller
    function hapusReseller($id)
    {
        // API untuk menghapus toko
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/deletetoko/' . $id;

        // token yang dibutuhkan
        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        try {
            // delete data reseller lewat API 
            $client->delete($URI, $params);

            // diarahkan ke halaman data reseller kembali dengan pesan success
            return redirect()->route('adminDataResellerView')->with('success', 'Data Reseller berhasil dihapus!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi untuk menampilkan halaman ubah data reseller jika admin menekan button ubah
    function editReseller($id)
    {
        // API untuk mendapatkan data reseller dari id
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/datareseller/' . $id;

        // token yang dibutuhkan
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            // mengambil data reseller dari database lewat API
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $data = json_decode(Cookie::get('profileUser'), true);

            // diarahkan ke halaman edit reseller jika berhasil dengan data berikut
            return view('admin/admin_edit_reseller')->with([
                'data' => $response,
                'dataProfile' => $data,
                'title' => "Edit Profil"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang dijalankan jika admin menyimpan perubahan data reseller
    function simpanEditReseller(Request $request, $id)
    {
        // API untuk mengubah data reseller dengan id
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/updatetoko/' . $id;

        // validasi inputan yang masuk
        $request->validate([
            'namatoko' => ['required'],
            'phone' => ['required', 'numeric', 'digits_between:10,15']
        ], [
            'namatoko.required' => 'Kamu harus mengisi Nama Toko!',
            'phone.required' => 'Kamu harus mengisi Nomor Telepon!',
            'phone.numeric' => 'Nomor telepon harus angka!',
            'phone.digits_between' => 'Nomor telepon harus 10 s.d 15 digit!',
        ]);

        // token yang dibutuhkan
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        // data edit yang akan dikirim ke database
        $params['form_params'] = array(
            'namatoko' => $request->namatoko,
            'phone' => $request->phone,
        );

        try {
            // mengubah data ke database lewat API
            $action = $client->put($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            // diarahkan kembali ke halaman data reseller dengan pesan success
            return redirect()->route('adminDataResellerView')->with('success', 'Data Reseller berhasil diubah!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
