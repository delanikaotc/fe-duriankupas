<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class UserProfileController extends Controller
{
    function index()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/profile/' . cookie::get('idUser');

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);
            Log::info(cookie::get('accessToken'));
            Log::info(cookie::get('roleUser'));

            return view('user/user_home')->with([
                'data' => $response,
                'title' => "Profil"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function editProfil($id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/profile/' . $id;

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            return view('user/user_edit_profil')->with([
                'data' => $response,
                'title' => "Edit Profil"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    function simpanEditProfil(Request $request, $id)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/update/' . $id;

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
            'phone' => $request->phone,
            'jeniskelamin' => $request->jeniskelamin,
            'tanggallahir' => $request->tanggallahir,
        );

        try {
            $action = $client->put($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            return redirect()->route('userProfileView')->with('success', 'Data berhasil diubah!');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->route('userProfileView')->withErrors([$e->getMessage()]);
        }
    }
}
