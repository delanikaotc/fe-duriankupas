<?php

namespace App\Http\Controllers\Admin;

// controller untuk form unggah bukti kirim admin
use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminFormUploadBuktiController extends Controller
{
    // fungsi untuk menampilkan halaman ungah bukti kirim dengan mendapatkan id data pengajuan tarik uang
    function index($id)
    {
        // URI API untuk mendapatkan data pengajuan tarik uang by id 
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/datatarikuang/' . $id;

        // token yang dibutuhkan untuk mengakses fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            // mendapatkan data pesanan dari database lewat API
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            // diarahkan ke halaman form unggah bukti apabila berhasil dengan data berikut
            return view('admin/admin_form_upload_bukti')->with([
                'dataTarikUang' => $response,
                'dataProfile' => $data,
                'title' => "Form Upload Bukti"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang dijalankan jika admin menekan button unggah bukti
    function uploadBukti(Request $request, $id)
    {
        // URI API untuk mengirimkan bukti kirim uang dengan id data penarikan
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/transfer/' . $id;

        // memasukkan file image ke dalam variabel agar lebih mudah
        $file = $request->file('image');

        // validasi gambar yang diinput
        $request->validate([
            'image' => ['required', 'mimes:jpeg,jpg,png'],
        ], [
            'image.required' => 'Kamu harus menambahkan Gambar Bukti!',
            'image.mimes' => 'Gambar harus .jpeg, .jpg, atau .png',
        ]);

        // token yang dibutuhkan untuk akses fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        // gambar yang didapatkan dari frontend
        $params['multipart'] = array(
            [
                'name' => 'image',
                'contents' => file_get_contents($file->getPathname()),
                'filename' => $file->getClientOriginalName()
            ]
        );

        try {
            // mengirimkan gambar ke database lewat API
            $action = $client->put($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            // diarahkan ke halaman data tarik uang jika berhasil dengan pesan success
            return redirect()->route('adminDataTarikUangView')->with('success', 'Bukti berhasil diunggah!');
        } catch (Exception $e) {
            Log::error($e);
            // diarahkan ke halaman data tarik uang jika gagal dengan pesan gagal
            return redirect()->route('adminDataTarikUangView')->withErrors(['Gagal mengunggah bukti!']);
        }
    }
}
