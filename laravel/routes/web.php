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