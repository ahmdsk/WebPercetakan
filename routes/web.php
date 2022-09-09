<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [LandingPageController::class, 'index'])->name('landing.home');
Route::get('/kategori/{slug}', [LandingPageController::class, 'detailKategori'])->name('landing.kategori');
Route::get('/ambilKategori', [LandingPageController::class, 'getKategori'])->name('ambilKategori');
Route::get('/jumlahCart', [PemesananController::class, 'jumlahCart'])->name('cart.jumlah');

Route::get('/cari', [HomeController::class, 'cariProduk'])->name('cari');

Route::get('/detailproduk/{id}', [ProductsController::class, 'detailProduk'])->name('produk.detail');

Route::get('/cekresi', [PemesananController::class, 'cekResi'])->name('cekresi');
Route::post('/cekresi', [PemesananController::class, 'cekResiPost']);

Route::post('/profile/ubah', [ProfileController::class, 'ubahProfile'])->name('profile.ubah');
Route::post('/profile/ubahpass', [ProfileController::class, 'ubahKataSandi'])->name('profile.ubahKataSandi');

Auth::routes();

Route::get('/rekomendasi', [RekomendasiController::class, 'rekomendasi']);

// Routing untuk admin
Route::middleware('admin')->group(function(){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::post('/users/tambah', [UsersController::class, 'tambahUser'])->name('tambah.user');
    Route::get('/user/edit/{id}', [UsersController::class, 'editUser']);
    Route::post('/user/edit/{id}', [UsersController::class, 'updateUser']);
    Route::post('/user/hapus/{id}', [UsersController::class, 'hapusUser']);
    Route::post('/user/resetpassword/{id}', [UsersController::class, 'resetPasswordUser']);

    Route::get('/setting/pembayaran', [KelolaPembayaranController::class, 'index'])->name('pembayaran');
    Route::post('/setting/pembayaran/add', [KelolaPembayaranController::class, 'tambahPembayaran'])->name('tambah.pembayaran');
    Route::get('/setting/pembayaran/edit/{id}', [KelolaPembayaranController::class, 'editPembayaran']);
    Route::post('/setting/pembayaran/edit/{id}', [KelolaPembayaranController::class, 'updatePembayaran']);
    Route::post('/setting/pembayaran/hapus/{id}', [KelolaPembayaranController::class, 'hapusPembayaran']);

    Route::get('/setting/perusahan', [HomeController::class, 'settingperusahan'])->name('settingperusahan');
    Route::post('/setting/perusahan/ubahprofile', [HomeController::class, 'ubahprofile'])->name('ubahProfile');

    Route::get('/products', [ProductsController::class, 'index'])->name('products');
    Route::post('/products/add', [ProductsController::class, 'store'])->name('add_product');
    Route::get('/products/edit/{id}', [ProductsController::class, 'edit']);
    Route::post('/products/edit/{id}', [ProductsController::class, 'update']);
    Route::post('/products/delete/{id}', [ProductsController::class, 'destroy']);

    Route::get('/products/galeri/{id}', [ProductsController::class, 'galery'])->name('product.galery');
    Route::post('/products/galeri/tambah', [ProductsController::class, 'tambahGalery'])->name('tambah.galeri');
    Route::get('/products/galeri/edit/{id}', [ProductsController::class, 'editGalery']);
    Route::post('/products/galeri/edit/{id}', [ProductsController::class, 'updateGalery']);
    Route::post('/products/galeri/hapus/{id}', [ProductsController::class, 'hapusGalery']);

    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/category/add', [CategoryController::class, 'store'])->name('add_category');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('/category/edit/{id}', [CategoryController::class, 'update']);
    Route::post('/category/delete/{id}', [CategoryController::class, 'destroy']);

    Route::get('/datapesanan', [PemesananController::class, 'kelolaPesanan'])->name('kelola.pesanan');
    Route::get('/laporantransaksi', [PemesananController::class, 'laporanDataTransaksi'])->name('laporantransaksi');
    Route::post('/konfir_pembayaran', [PemesananController::class, 'konfirPesanan']);
    Route::get('/pesanan/ubahstatus/{id}', [PemesananController::class, 'ubahStatusPesanan']);
    Route::post('/pesanan/ubahstatus/', [PemesananController::class, 'updateStatusPesanan'])->name('pesanan.ubahstatus');
});

// Routing untuk user
Route::middleware('user')->group(function(){
    Route::get('/user/profile', [ProfileController::class, 'userProfile'])->name('profile.user');

    Route::get('/products/semua', [ProductsController::class, 'semuaProduk'])->name('product.semua');
    Route::get('/products/order', [ProductsController::class, 'orderProduk'])->name('produk.order');
    Route::post('/products/order', [ProductsController::class, 'orderProdukPost']);

    Route::post('/ulasan', [ProductsController::class, 'beriUlasan'])->name('ulasan');
    Route::post('/ulasan/edit', [ProductsController::class, 'editUlasan'])->name('edit.ulasan');

    Route::post('/products/pesanan', [PemesananController::class, 'pesanProduk'])->name('produk.pesan');
    Route::get('/pesanan', [PemesananController::class, 'dataPesanan'])->name('pesanan');

    Route::get('/konfir_bayar/{kode}', [PemesananController::class, 'konfirPembayaran']);
    Route::post('/konfir_bayar', [PemesananController::class, 'konfirPembayaranPost']);

    Route::get('/ambilKeranjang', [PemesananController::class, 'ambilCart'])->name('cart.ambil');
    Route::post('/hapusCart/{id}', [PemesananController::class, 'hapusCart']);
    Route::post('/cart/{product_id}', [PemesananController::class, 'tambahCart'])->name('cart');
});