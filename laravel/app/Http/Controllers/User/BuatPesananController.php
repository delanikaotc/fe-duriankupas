<?php

namespace App\Http\Controllers\User;

// controller untuk mengatur fungsi pada halaman buat pesanan
use App\Http\Controllers\Controller;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class BuatPesananController extends Controller
{
    // fungsi yang dijalankan ketika klik button 'Buat Pesanan' pada halaman produk kami 
    function buatPesanan(Request $request)
    {
        $client = new Client();
        // URI untuk post data pesanan yang didapat dari halaman produk kami
        $URI = 'https://beduriankupas.herokuapp.com/api/users/pesan';
        // URI untuk get data produk yang ada di database
        $URIProduk = 'https://beduriankupas.herokuapp.com/api/users';

        // membutuhkan token user untuk melanjutkan aktivitas pembelian
        $params['headers'] = array(
            'token' => 'Bearer ' . cookie::get('accessToken'),
        );

        // assign semua request ke dalam variabel input
        $input = $request->all();
        // membuat array kosong untuk menampung pesananan dari halaman produk kami
        $semuaProduk = [];

        // setiap input dicek, jika field jumlah yang ada di halaman produk kami tidak kosong, 
        // dimasukkan ke dalam array kosong semuaProduk untuk menyimpan pesanan dengan array 'nama produk' dan 'jumlah'

        foreach ($input['ArrPesanan'] as $i) {
            if ($i['jumlah'] > 0 && $i['jumlah'] != null) {
                array_push($semuaProduk, $i);
            }
        }

        // data yang dibutuhkan untuk post datapesanan ke database
        $params['form_params'] = array(
            'userId' => Cookie::get('idUser'),
            'pesanan' => $semuaProduk
        );

        try {
            // jika pada array semuaproduk terdapat field yang kosong tidak akan melanjutkan fungsi dan return ke halaman buat pesanan
            if (!empty($semuaProduk)) {
                // jika semua field pada array semuaproduk terisi, akan menjalankan fungsi untuk post data pesanan dan get data produk
                // post data pesanan ke database lewat API
                $action = $client->post($URI, $params);
                // get data produk ke database lewat API
                $actionProduk = $client->get($URIProduk);

                // membuat cookie untuk menyimpan jumlah dan produk yang dipesan
                $cookiePesanan  =  cookie('pesanan', $action->getBody(), 60);
                $cookieProduk  =  cookie('produk', $actionProduk->getBody(), 60);

                return redirect()->route('buatPesananView')->withCookies([$cookiePesanan, $cookieProduk]);
            }
        } catch (Exception $e) {
            Log::error($e);
        }
        // menangani kondisi apabila tidak memasukkan jumlah dan klik buat pesanan
        return redirect()->back()->withErrors(['Masukkan jumlah dengan benar!']);
    }

    // fungsi yang dijalankan ketika pengguna klik button 'lanjut pembayaran' di halaman buat pesanan
    function updatePesanan(Request $request, $id)
    {
        // URI untuk menambahkan data pesanan sesuai id pesanan yang didapat
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/detail/' . $id;

        // pengecekan apabila data provinsi dan kota tidak sesuai
        if ($request->provinsi == 'Pilih Provinsi') {
            return redirect()->route('buatPesananView')->withErrors(['Pilih Provinsi kamu!']);
        }

        if ($request->kota == 'Pilih Kab/Kota') {
            return redirect()->route('buatPesananView')->withErrors(['Pilih Kabupaten/Kota kamu!']);
        }

        // pengecekkan data untuk field yang required
        $request->validate([
            'provinsi' => ['required'],
            'kota' => ['required'],
            'kecamatan' => ['required'],
            'alamat' => ['required'],
            'kodePos' => ['required']
        ], [
            'provinsi.required' => 'Kamu harus mengisi Provinsi!',
            'kota.required' => 'Kamu harus mengisi Kota!',
            'kecamatan.required' => 'Kamu harus mengisi Kecamatan!',
            'alamat.required' => 'Kamu harus mengisi Alamat!',
            'kodePos.required' => 'Kamu harus mengisi Kode Pos!',
        ]);

        // token yang diperlukan untuk melanjutkan fungsi
        $params['headers'] = array(
            'token' => 'Bearer ' . Cookie::get('accessToken'),
        );

        // data yang diperlukan untuk dikirim ke database
        $params['form_params'] = array(
            'total' => $request->total,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'alamat' => $request->alamat
        );

        try {
            // mengupdate data pesanan dengan memasukkan data yang didapatkan
            $action = $client->put($URI, $params);
            $response = json_decode($action->getBody()->getContents(), true);

            $data = json_decode(Cookie::get('profileUser'), true);

            // diarahkan ke halaman pembayaran jika berhasil dengan pesan sukses
            return view('user/user_pembayaran', [
                'dataPesanan' => $response,
                'data' => $data,
                'title' => "Pembayaran",
                'success' => "Data Pesanan berhasil dibuat!"
            ]);
        } catch (Exception $e) {
            Log::error($e);
            // diarahkan ke halaman buat pesanan kembali jika terdapat error
            return redirect()->route('indexBuatPesanan')->withErrors([$e->getMessage()]);
        }
    }

    // fungsi untuk mengatur data yang dibutuhkan pada halaman buat pesanan
    function indexBuatPesanan()
    {
        // link API untuk mendapatkan data daerah
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/region';

        // melakukan get data daerah dari URI
        $action = $client->get($URI);
        $response = json_decode($action->getBody()->getContents(), true);

        // assign cookie ke variabel 
        $data = json_decode(Cookie::get('profileUser'), true);
        $pesanan = json_decode(Cookie::get('pesanan'), true);
        $produk = json_decode(Cookie::get('produk'), true);

        // diarahkan ke halaman buat pesanan dengan mengirimkan datapesanan, dataproduk, dan datadaerah untuk diload
        return view('user/user_buat_pesanan', [
            'dataPesanan' => $pesanan,
            'dataProduk' => $produk,
            'dataDaerah' => $response,
            'data' => $data,
            'title' => "Buat Pesanan"
        ]);

        // cookie yang ada di halaman produk kami dihapus 
        Cookie::expire('produk');
        Cookie::expire('pesanan');
    }


    // fungsi getKota untuk membuat dependent dropdown ketika memilih provinsi dan kota
    function getKota(Request $request)
    {
        // URI untuk get data daerah
        $client = new Client();
        $URI = 'https://beduriankupas.herokuapp.com/api/users/region';

        // command untuk get data daerah
        $action = $client->get($URI);
        $response = json_decode($action->getBody()->getContents(), true);

        // mengambil nama_provinsi yang sudah diassign di halaman buat pesanan pada script
        $nama_provinsi = $request->nama_provinsi;

        // setiap data yang diambil dari API dicek apabila nama provinsinya sesuai dengan nama provinsi yang dipilih di halaman baut pesanan
        // akan dijalankan command untuk memberikan nama kota apa saja yang sesuai dengan provinsinya untuk diload di halaman buat pesanan
        foreach ($response as $provinsi) {
            if ($provinsi['provinsi'] ==  $nama_provinsi) {
                $kota = $provinsi['kota'];
                Log::info($kota);
                foreach ($kota as $k) {
                    echo "<option value='$k'>$k</option>";
                }
            }
        }
    }
}
