<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\MasukController;
use App\Http\Controllers\ProdukController;

//user
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\BuatPesananController;
use App\Http\Controllers\User\PembayaranController;
use App\Http\Controllers\User\UserPesananController;
use App\Http\Controllers\User\BeriUlasanController;

//reseller
use App\Http\Controllers\Reseller\ResellerDashboardController;
use App\Http\Controllers\Reseller\ResellerDataPemesananController;
use App\Http\Controllers\Reseller\ResellerDataRestockController;
use App\Http\Controllers\Reseller\ResellerFormRestockController;
use App\Http\Controllers\Reseller\ResellerDataTarikUangController;
use App\Http\Controllers\Reseller\ResellerFormTarikUangController;

// admin
use App\Http\Controllers\Admin\AdminDataPemesananController;
use App\Http\Controllers\Admin\AdminDataPembeliController;
use App\Http\Controllers\Admin\AdminDataResellerController;
use App\Http\Controllers\Admin\AdminDataProdukController;
use App\Http\Controllers\Admin\AdminFormTambahResellerController;
use App\Http\Controllers\Admin\AdminDataRestockController;
use App\Http\Controllers\Admin\AdminDataTarikUangController;
use App\Http\Controllers\Admin\AdminFormTambahProdukController;
use App\Http\Controllers\Admin\AdminFormUploadBuktiController;

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
Route::post('/buat-pesanan', [BuatPesananController::class, 'buatPesanan'])->name('buatPesanan')->middleware(['IsAuth', 'IsUser']);
Route::post('/pembayaran/{id}', [BuatPesananController::class, 'updatePesanan'])->name('updatePesanan')->middleware(['IsAuth', 'IsUser']);
Route::get('/pembayaran/{id}', [PembayaranController::class, 'index'])->name('pembayaranView')->middleware(['IsAuth', 'IsUser']);
Route::post('/upload-bukti-pembayaran/{id}', [PembayaranController::class, 'uploadBuktiPembayaran'])->name('uploadBuktiPembayaran')->middleware(['IsAuth', 'IsUser']);
Route::get('/pesanan', [UserPesananController::class, 'index'])->name('userPesananView')->middleware(['IsAuth', 'IsUser']);
Route::get('/beri-ulasan/{id}', [BeriUlasanController::class, 'index'])->name('beriUlasanView')->middleware(['IsAuth', 'IsUser']);
Route::post('/beri-ulasan/{id}', [BeriUlasanController::class, 'kirimUlasan'])->name('kirimUlasan')->middleware(['IsAuth', 'IsUser']);
Route::post('/pesanan-sampai/{id}', [UserPesananController::class, 'pesananSampai'])->name('pesananSampai')->middleware(['IsAuth', 'IsUser']);
Route::get('/rincian-pesanan/{id}', [UserPesananController::class, 'rincianPesanan'])->name('rincianPesananView')->middleware(['IsAuth', 'IsUser']);

// Reseller
Route::get('/dashboard', [ResellerDashboardController::class, 'index'])->name('resellerDashboardView')->middleware(['IsAuth', 'IsReseller']);
Route::get('/data-pemesanan-baru', [ResellerDataPemesananController::class, 'indexPemesananBaru'])->name('resellerDataPemesananBaruView')->middleware(['IsAuth', 'IsReseller']);
Route::get('/riwayat-data-pemesanan', [ResellerDataPemesananController::class, 'indexRiwayatPemesanan'])->name('resellerRiwayatDataPemesananView')->middleware(['IsAuth', 'IsReseller']);
Route::post('/pesanan-terkirim/{id}', [ResellerDataPemesananController::class, 'barangDikirim'])->name('barangDikirim')->middleware(['IsAuth', 'IsReseller']);
Route::get('/data-restock', [ResellerDataRestockController::class, 'index'])->name('resellerDataRestockView')->middleware(['IsAuth', 'IsReseller']);
Route::get('/form-restock', [ResellerFormRestockController::class, 'index'])->name('resellerFormRestockView')->middleware(['IsAuth', 'IsReseller']);
Route::post('/form-restock', [ResellerFormRestockController::class, 'ajukanRestock'])->name('ajukanRestock')->middleware(['IsAuth', 'IsReseller']);
Route::get('/data-tarik-uang', [ResellerDataTarikUangController::class, 'index'])->name('resellerDataTarikUangView')->middleware(['IsAuth', 'IsReseller']);
Route::get('/form-tarik-uang', [ResellerFormTarikUangController::class, 'index'])->name('resellerFormTarikUangView')->middleware(['IsAuth', 'IsReseller']);
Route::post('/form-tarik-uang', [ResellerFormTarikUangController::class, 'ajukanPenarikan'])->name('ajukanPenarikan')->middleware(['IsAuth', 'IsReseller']);



// Admin -> Pemesanan
Route::get('/admin/data-pemesanan', [AdminDataPemesananController::class, 'index'])->name('adminDataPemesananView')->middleware(['IsAuth', 'IsAdmin']);
Route::post('/admin/pembayaran-terverifikasi/{id}', [AdminDataPemesananController::class, 'terimaBuktiPembayaran'])->name('terimaBuktiPembayaran')->middleware(['IsAuth', 'IsAdmin']);

//Admin -> Reseller
Route::get('/admin/data-reseller', [AdminDataResellerController::class, 'index'])->name('adminDataResellerView')->middleware(['IsAuth', 'IsAdmin']);
Route::get('/admin/tambah-reseller', [AdminFormTambahResellerController::class, 'index'])->name('adminFormTambahResellerView')->middleware(['IsAuth', 'IsAdmin']);
Route::post('/admin/tambah-reseller', [AdminFormTambahResellerController::class, 'tambahReseller'])->name('tambahReseller')->middleware(['IsAuth', 'IsAdmin']);
Route::post('/admin/hapus-reseller/{id}', [AdminDataResellerController::class, 'hapusReseller'])->name('hapusReseller')->middleware(['IsAuth', 'IsAdmin']);

//Admin -> Restock
Route::get('/admin/data-restock', [AdminDataRestockController::class, 'index'])->name('adminDataRestockView')->middleware(['IsAuth', 'IsAdmin']);
Route::post('/admin/kirim-restock/{id}', [AdminDataRestockController::class, 'kirimRestock'])->name('kirimRestock')->middleware(['IsAuth', 'IsAdmin']);

//Admin -> Tarik Uang
Route::get('/admin/data-tarik-uang', [AdminDataTarikUangController::class, 'index'])->name('adminDataTarikUangView')->middleware(['IsAuth', 'IsAdmin']);
Route::get('/admin/upload-bukti/{id}', [AdminFormUploadBuktiController::class, 'index'])->name('adminFormUploadBuktiView')->middleware(['IsAuth', 'IsAdmin']);
Route::post('/admin/upload-bukti/{id}', [AdminFormUploadBuktiController::class, 'uploadBukti'])->name('uploadBukti')->middleware(['IsAuth', 'IsAdmin']);

//Admin -> Produk
Route::get('/admin/data-produk', [AdminDataProdukController::class, 'index'])->name('adminDataProdukView')->middleware(['IsAuth', 'IsAdmin']);
Route::get('/admin/form-tambah-produk', [AdminFormTambahProdukController::class, 'index'])->name('adminFormTambahProdukView')->middleware(['IsAuth', 'IsAdmin']);
Route::post('/admin/form-tambah-produk', [AdminFormTambahProdukController::class, 'tambahProduk'])->name('tambahProduk')->middleware(['IsAuth', 'IsAdmin']);
Route::post('/admin/hapus-produk/{id}', [AdminDataProdukController::class, 'hapusProduk'])->name('hapusProduk')->middleware(['IsAuth', 'IsAdmin']);
Route::get('/admin/edit-produk/{id}', [AdminDataProdukController::class, 'indexEditProduk'])->name('adminEditProdukView')->middleware(['IsAuth', 'IsAdmin']);
Route::post('/admin/edit-produk/{id}', [AdminDataProdukController::class, 'simpanEditProduk'])->name('simpanEditProduk')->middleware(['IsAuth', 'IsAdmin']);


Route::get('/admin/data-pembeli', [AdminDataPembeliController::class, 'index'])->name('adminDataPembeliView')->middleware(['IsAuth', 'IsAdmin']);
Route::post('/admin/hapus/{id}', [AdminDataPembeliController::class, 'hapusPembeli'])->name('hapusPembeli')->middleware(['IsAuth', 'IsAdmin']);



// Main Page
//Produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produkView');
