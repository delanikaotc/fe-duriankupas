<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;



class DaftarController extends Controller
{
    function index()
    {
        return view('daftar', ["title" => "Daftar"]);
    }

    function daftar(Request $request)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/auth/register';

        $request->validate([
            'username' => ['required', 'min:6', 'max:30'],
            'email' => ['required'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8'],
            'phone' => ['required', 'numeric', 'digits_between:10,15'],
        ], [
            'username.required' => 'Kamu harus mengisi Username!',
            'username.min' => 'Username minimal 6 karakter!',
            'username.max' => 'Username maksimal 30 karakter!',
            'email.required' => 'Kamu harus mengisi Email!',
            'password.required' => 'Kamu harus mengisi Kata Sandi!',
            'password.min' => 'Kata Sandi minimal 8 karakter!',
            'password.confirmed' => 'Kata Sandi tidak sama!',
            'password_confirmation.required' => 'Kamu harus mengetik ulang Kata Sandi!',
            'password_confirmation.min' => 'Kata Sandi minimal 8 karakter!',
            'phone.required' => 'Kamu harus mengisi Nomor Telepon!',
            'phone.digits_between' => 'Nomor Telepon harus 10 s.d. 15 angka!',
            'phone.numeric' => 'Nomor Telepon harus angka!',
        ]);

        $params['form_params'] = array(
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone
        );

        try {
            $action = $client->post($URI, $params);
            $responseJson = $action->getBody();
            $response = json_decode($responseJson, true);

            $profile = cookie('profileUser', $responseJson, 60);
            $idUser = cookie('idUser', $response['savedUser']['_id'], 60);
            $roleUser = cookie('roleUser', $response['savedUser']['role'], 60);
            $tokenCookie = cookie('accessToken', $response['accessToken'], 60);

            Log::info($profile);

            return redirect()->route('userProfileView')->withCookies([$tokenCookie, $idUser, $profile, $roleUser]);
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->route('daftarView')->withErrors([$e->getMessage()]);
        }
    }
}
