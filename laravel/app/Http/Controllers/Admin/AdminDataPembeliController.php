<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use FFI\Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class AdminDataPembeliController extends Controller
{
    function index()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/dataPembeli';

        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            return view('admin/admin_data_pembeli')->with([
                'data' => $response,
                'dataProfile' => $data,
                'title' => "Data Pembeli"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function hapusPembeli($id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/deletePembeli/' . $id;

        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        try {
            $client->delete($URI, $params);
            return redirect()->route('adminDataPembeliView')->with('success', 'Data Pembeli berhasil dihapus!');
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function editPembeli($id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/datapembeli/' . $id;

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $data = json_decode(Cookie::get('profileUser'), true);
            Log::info($response);

            return view('admin/admin_edit_pembeli')->with([
                'data' => $response,
                'dataProfile' => $data,
                'title' => "Edit Profil"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function simpanEditPembeli(Request $request, $id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/admin/updatepembeli/' . $id;

        $request->validate([
            'phone' => ['required', 'numeric', 'digits_between:10,15'],
            'tangallahir' => ['date']
        ], [
            'phone.required' => 'Kamu harus mengisi Nomor Telepon!',
            'phone.numeric' => 'Nomor telepon harus angka!',
            'phone.digits_between' => 'Nomor telepon harus 10 s.d 15 digit!',
            'tanggallahir.date' => 'Tanggal lahir harus berupa tanggal!'
        ]);

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        $params['form_params'] = array(
            'tanggallahir' => $request->tanggallahir,
            'jeniskelamin' => $request->jeniskelamin,
            'phone' => $request->phone
        );

        Log::info($params['form_params']);

        try {
            $action = $client->put($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            if (empty($response)) {
                return redirect()->route('adminDataPembeliView')->withErrors(['Data tidak terubah!']);
            } else {
                return redirect()->route('adminDataPembeliView')->with('success', 'Data Pembeli berhasil diubah!');
            }
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->route('editPembeli')->withErrors($e->getMessage());
        }
    }
}
