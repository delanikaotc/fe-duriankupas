<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;

// controller untuk halaman data pemesanan
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ResellerDataPemesananController extends Controller
{
    // fungsi untuk menampilkan data pemesanan baru
    function indexPemesananBaru()
    {
        // link API URI untuk mengambil data pemesanan
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/reseller/datapesanan';

        // token yang dibutuhkan untuk akses fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            // mengambil data pemesanan lewat API
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);
            $isStockAvailable = $this->periksaStock($response['pesananBaru']);
            Log::debug($isStockAvailable);

            //jika berhasil akan diarahkan ke halaman data pemesanan baru dengan data berikut
            return view('reseller/reseller_data_pemesanan_baru')->with([
                'dataProfile' => $data,
                'data' => $response,
                'title' => "Data Pemesanan",
                'status' => $isStockAvailable
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // sama dengan fungsi untuk menampilkan data pesanan baru, namun ini data pemesanan yang sudah dikirim
    function indexRiwayatPemesanan()
    {
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/reseller/datapesanan';

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            Log::info($response);

            $data = json_decode(Cookie::get('profileUser'), true);

            return view('reseller/reseller_data_pemesanan_lama')->with([
                'dataProfile' => $data,
                'data' => $response,
                'title' => "Data Pemesanan"
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    // fungsi yang akan dijalankan ketika reseller klik button kirim barang
    function barangDikirim($id)
    {
        // link API URI untuk mengedit data pesanan menggunakan id
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/reseller/dikirim/' . $id;

        // token yang dibutuhkan 
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            // mengedit status pesanan menjadi 'sudah dikirim' untuk ditampilkan ke halaman user
            $client->put($URI, $params);
            // jika berhasil akan diarahkan ke halaman data pemesanan dengan message success
            return redirect()->route('resellerDataPemesananBaruView')->with('success', 'Barang berhasil dikirim!');
        } catch (Exception $e) {

            Log::error($e);
        }
    }

    function periksaStock($dataPesanan)
    {
        $isStockAvailable = [];
        $client = new Client();
        $URI = 'https://beduriankupas.tykozidane.xyz/api/reseller/';

        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        try {
            $action = $client->get($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);
            $dataStock = $response['tokonya']['stock'];
        } catch (Exception $e) {
            Log::error($e);
        }

        for ($i = 0; $i < count($dataPesanan); $i++) {
            $isStockAvailable[$dataPesanan[$i]['_id']] = true;
            for ($j = 0; $j < count($dataPesanan[$i]['pesanan']); $j++) {
                for ($k = 0; $k < count($dataStock); $k++) {
                    $itemDurian = $dataStock[$k];
                    if ($dataPesanan[$i]['pesanan'][$j]['product'] == $itemDurian['product']) {
                        if ($dataPesanan[$i]['pesanan'][$j]['jumlah'] > $itemDurian['jumlah'] || $isStockAvailable[$dataPesanan[$i]['_id']] == false) {
                            $isStockAvailable[$dataPesanan[$i]['_id']] = false;
                            break;
                        }
                    }
                }
            }
        }
        return $isStockAvailable;
    }
}
