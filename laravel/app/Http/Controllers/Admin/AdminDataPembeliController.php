<?php

namespace App\Http\Controllers\Admin;

// controller untuk halaman data pembeli 
use App\Http\Controllers\Controller;
use FFI\Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminDataPembeliController extends Controller
{
    // fungsi untuk menampilkan halaman data pembeli
    function index()
    {
        // URI API untuk mendapatkan semua data pembeli
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/admin/dataPembeli';

        // token untuk menjalankan fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        try {
            // mendapatkan data pembeli dari database lewat API
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            // apabila berhasil diarahkan ke halaman data pembeli dengan data berikut
            return view('admin/admin_data_pembeli')->with([
                'data' => $response,
                'dataProfile' => $data,
                'title' => "Data Pembeli"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang dijalankan jika admin menghapus data pembeli
    function hapusPembeli($id)
    {
        // API untuk menghapus data pembeli
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/admin/deletePembeli/' . $id;

        // token yang dibutuhkan
        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        try {
            // delete data pembeli dari database lewat API
            $client->delete($URI, $params);

            // diarahkan ke halaman data pembeli dengan pesan success
            return redirect()->route('adminDataPembeliView')->with('success', 'Data Pembeli berhasil dihapus!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang dijalankan jika admin memencet button ubah data pembeli
    function editPembeli($id)
    {
        // mengambil data pembeli sesuai id
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/admin/datapembeli/' . $id;

        // token yang dibutuhkan
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            // mengambil data pembeli dari database
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $data = json_decode(Cookie::get('profileUser'), true);

            // diarahkan ke halaman edit pembeli dengan data berikut
            return view('admin/admin_edit_pembeli')->with([
                'data' => $response,
                'dataProfile' => $data,
                'title' => "Edit Profil"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang dijalankan ketika admin menyimpan perubahan data pembeli
    function simpanEditPembeli(Request $request, $id)
    {
        // API untuk mengubah data pembeli dengan id
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/admin/updatepembeli/' . $id;

        // validasi data yang diinputkan
        $request->validate([
            'phone' => ['required', 'numeric', 'digits_between:10,15'],
            'tangallahir' => ['date']
        ], [
            'phone.required' => 'Kamu harus mengisi Nomor Telepon!',
            'phone.numeric' => 'Nomor telepon harus angka!',
            'phone.digits_between' => 'Nomor telepon harus 10 s.d 15 digit!',
            'tanggallahir.date' => 'Tanggal lahir harus berupa tanggal!'
        ]);

        // token yang dibutuhkan
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        // data yang akan dikirimkan ke database
        $params['form_params'] = array(
            'tanggallahir' => $request->tanggallahir,
            'jeniskelamin' => $request->jeniskelamin,
            'phone' => $request->phone
        );

        try {
            // mengubah data pembeli ke database lewat API
            $action = $client->put($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            // jika data yang diinputkan kosong, maka terdapat error data tidak terubah
            if (empty($response)) {
                return redirect()->route('adminDataPembeliView')->withErrors(['Data tidak terubah!']);
            } else {
                // jika data sesuai maka diarahkan ke halaman data pembeli dengan pesan sukses
                return redirect()->route('adminDataPembeliView')->with('success', 'Data Pembeli berhasil diubah!');
            }
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->route('editPembeli')->withErrors($e->getMessage());
        }
    }
}
