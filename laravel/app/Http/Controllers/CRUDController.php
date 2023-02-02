<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CRUDController extends Controller
{
    function create(Request $request)
    {
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/auth/register';

        $request->validate([
            'username' => ['required']
        ], [
            'username.required' => 'kamu harus mengisi username!'
        ]);

        $params['form_params'] = array(
            'username' => $request->username,
        );

        try {
            $client->post($URI, $params);
            return redirect()->route('home');
        } catch (Exception $e) {
            return redirect()->route('home')->withErrors([$e]);
        }
    }

    function read()
    {
        $client = new Client();
        $URI = 'abc';

        try {
            $action = $client->get($URI);
            $response =  json_decode($action->getBody()->getContents(), true);

            return view('home', [
                'dataProduk' => $response
            ]);
        } catch (Exception $e) {
            return redirect()->route('home')->withErrors([$e]);
        }
    }

    function update(Request $request, $id)
    {
        $client = new Client();
        $URI = 'abc' . $id;

        $request->validate([
            'username' => ['required']
        ], [
            'username.required' => 'kamu harus mengisi username!'
        ]);

        $params['form_params'] = array(
            'username' => $request->username
        );

        try {
            $client->put($URI, $params);
            return redirect()->route('home')->with('success', 'berhasil!');
        } catch (Exception $e) {
            return redirect()->route('home')->withErrors([$e]);
        }
    }

    function delete($id)
    {
        $client = new Client();
        $URI = 'abc' . $id;

        try {
            $client->delete($URI);
            return redirect()->route('home')->with('success', 'data berhasil dihapus!');
        } catch (Exception $e) {
            return redirect()->route('home')->withErrors([$e]);
        }
    }
}
