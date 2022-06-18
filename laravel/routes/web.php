<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\MasukController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Reseller\ResellerDashboardController;
use App\Http\Controllers\Reseller\ResellerDataPemesananController;
use App\Http\Controllers\Admin\AdminDataPemesananController;
use App\Http\Controllers\Admin\AdminDataPembeliController;
use App\Http\Controllers\Admin\AdminDataResellerController;
use App\Http\Controllers\Admin\AdminDataProdukController;



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

Route::get('/tentang', function () {
    return view('tentang');
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

//Home
Route::get('/', [HomeController::class, 'index'])->name('home');


// Daftar
Route::get('/daftar', [DaftarController::class, 'index'])->name('daftarView')->middleware('IsMasuk');
Route::post('/daftar', [DaftarController::class, 'daftar'])->name('daftar')->middleware('IsMasuk');

//Masuk
Route::get('/masuk', [MasukController::class, 'index'])->name('masukView')->middleware('IsMasuk');
Route::post('masuk', [MasukController::class, 'masuk'])->name('masuk')->middleware('IsMasuk');
Route::post('/keluar', [MasukController::class, 'keluar'])->name('keluar')->middleware('IsAuth');

// User
Route::get('/profil', [UserProfileController::class, 'index'])->name('userProfileView')->middleware(['IsAuth', 'IsUser']);
Route::post('/buat-pesanan', [ProdukController::class, 'buatPesanan'])->name('buatPesanan')->middleware(['IsAuth', 'IsUser']);


// Reseller
Route::get('/dashboard', [ResellerDashboardController::class, 'index'])->name('resellerDashboardView')->middleware(['IsAuth', 'IsReseller']);
Route::get('/data-pemesanan-baru', [ResellerDataPemesananController::class, 'indexPemesananBaru'])->name('resellerDataPemesananBaruView')->middleware(['IsAuth', 'IsReseller']);
Route::get('/riwayat-data-pemesanan', [ResellerDataPemesananController::class, 'indexRiwayatPemesanan'])->name('resellerRiwayatDataPemesananView')->middleware(['IsAuth', 'IsReseller']);


// Admin
Route::get('/admin/data-pemesanan', [AdminDataPemesananController::class, 'index'])->name('adminDataPemesananView')->middleware(['IsAuth', 'IsAdmin']);
Route::get('/admin/data-reseller', [AdminDataResellerController::class, 'index'])->name('adminDataResellerView')->middleware(['IsAuth', 'IsAdmin']);
Route::get('/admin/data-produk', [AdminDataProdukController::class, 'index'])->name('adminDataProdukView')->middleware(['IsAuth', 'IsAdmin']);
Route::get('/admin/data-pembeli', [AdminDataPembeliController::class, 'index'])->name('adminDataPembeliView')->middleware(['IsAuth', 'IsAdmin']);
Route::delete('/admin/hapus/{id}', [AdminDataPembeliController::class, 'hapusPembeli'])->middleware(['IsAuth', 'IsAdmin']);


// Main Page
//Produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produkView');
