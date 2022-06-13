<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        "title" => "duriankupas.id"
    ]);
});

Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/daftar', function () {
    return view('daftar', [
        "title" => "Daftar"
    ]);
});

Route::get('/masuk', function () {
    return view('masuk', [
        "title" => "Masuk"
    ]);
});

Route::get('/produk', function () {
    return view('produk', [
        "title" => "Produk Kami"
    ]);
});

Route::get('/buat-pesanan', function () {
    return view('buat_pesanan', [
        "title" => "Buat Pesanan"
    ]);
});

Route::get('/pembayaran', function () {
    return view('pembayaran', [
        "title" => "Pembayaran"
    ]);
});

Route::get('/user', function () {
    return view('user/user_home', [
        "title" => "User"
    ]);
});

Route::get('/pesanan', function () {
    return view('user/user_pesanan', [
        "title" => "Pesanan Saya"
    ]);
});

Route::get('/ulasan', function () {
    return view('user/user_ulasan', [
        "title" => "Ulasan Pesanan"
    ]);
});

Route::get('/rincian-pesanan', function () {
    return view('user/user_rincian_pesanan', [
        "title" => "Rincian Pesanan"
    ]);
});

Route::get('/reseller', function () {
    return view('reseller/reseller_home', [
        "title" => "Reseller"
    ]);
});

Route::get('/reseller-data-pemesanan', function () {
    return view('reseller/reseller_data_pemesanan', [
        "title" => "Data Pemesanan"
    ]);
});


Route::get('/admin', function () {
    return view('admin/admin_home', [
        "title" => "Admin"
    ]);
});

Route::get('/data-pengguna', function () {
    return view('admin/admin_data_pengguna', [
        "title" => "Admin"
    ]);
});
