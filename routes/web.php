<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_index;
use App\Http\Controllers\C_barang;
use App\Http\Controllers\C_pelanggan;
use App\Http\Controllers\C_pemesanan;
use App\Http\Controllers\C_penjualan;
use App\Http\Controllers\C_pemasok;
use App\Http\Controllers\C_pengadaan;
use App\Http\Controllers\C_laporan;

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

// Route::get('/', function () {
//     return view('index',['x' => 'home']);
// });
// Route::get('/home', function () {
//     return view('index',['x' => 'home']);
// });

//home
Route::get('/',[C_index::class,'index']);
Route::get('/home',[C_index::class,'index']);

Route::post('/profil/store',[C_index::class,'profil_store']);
Route::post('/profil/update/{id}',[C_index::class,'profil_update']);

//barang
Route::get('/barang',[C_barang::class,'index']);
Route::get('/barang/{id}',[C_barang::class,'indexKat']); //unused
Route::post('/barang/gambar/store/{id}',[C_barang::class,'storeGambar']);
Route::post('/barang/gambar/update/{id}/{id2}',[C_barang::class,'updateGambar']);
Route::post('/barang/store',[C_barang::class,'store']);
Route::post('/barang/update/{id}',[C_barang::class,'update']);

Route::get('/gbarang',[C_barang::class,'guest_index']);
Route::get('/gbarang/{id}',[C_barang::class,'guest_indexKat']); //unused

Route::get('/cbarang',[C_barang::class,'customer_index']);
Route::get('/cbarang/{id}',[C_barang::class,'customer_indexKat']);

//pelanggan
Route::get('/pelanggan',[C_pelanggan::class,'index']);
Route::post('/pelanggan/store',[C_pelanggan::class,'store']);
Route::post('/pelanggan/update/{id}',[C_pelanggan::class,'update']);

//pemesanan
Route::get('/cpemesanan',[C_pemesanan::class,'c_index']);
Route::get('/cpemesanan/{id}',[C_pemesanan::class,'c_indexKat']); //unused
Route::post('/cpemesanan/store',[C_pemesanan::class,'c_store']);
Route::post('/cpemesanan/detail/store/{id}',[C_pemesanan::class,'c_storeDetail']);
Route::post('/cpemesanan/detail/update/{id}/{id2}',[C_pemesanan::class,'c_updateDetail']);
Route::post('/cpemesanan/detail/delete/{id}/{id2}',[C_pemesanan::class,'c_deleteDetail']);
Route::post('/cpemesanan/submit/{id}',[C_pemesanan::class,'c_submit']);

Route::get('/apemesanan',[C_pemesanan::class,'a_index']);
Route::post('/apemesanan/confirm/{id}',[C_pemesanan::class,'a_confirm']);
Route::get('/apemesananv',[C_pemesanan::class,'a_view']);

//penjualan
Route::get('/penjualan',[C_penjualan::class,'index']);
Route::post('/penjualan/store',[C_penjualan::class,'store']);
Route::post('/penjualan/update/{id}',[C_penjualan::class,'update']);
Route::get('/penjualan/cetak/{id}',[C_penjualan::class,'cetak']);
Route::post('/penjualan/detail/store/{id}',[C_penjualan::class,'storeDetail']);
Route::post('/penjualan/detail/update/{id}/{id2}',[C_penjualan::class,'updateDetail']);
//pembayaran
Route::post('/pembayaran/store/{id}',[C_penjualan::class,'storePembayaran']);
Route::post('/pembayaran/update/{id}/{id2}',[C_penjualan::class,'updatePembayaran']);
//pengiriman
Route::get('/pengiriman/{id}',[C_penjualan::class,'indexPengiriman']);
Route::post('/pengiriman/store/{id}',[C_penjualan::class,'storePengiriman']);
Route::post('/pengiriman/update/{id}/{id2}',[C_penjualan::class,'updatePengiriman']);
Route::post('/pengiriman/detail/store/{id}',[C_penjualan::class,'storeDetailPengiriman']);
Route::post('/pengiriman/detail/update/{id}/{id2}',[C_penjualan::class,'updateDetailPengiriman']);

Route::get('/penjualan/n',[C_penjualan::class,'index2']);

//pemasok
Route::get('/pemasok',[C_pemasok::class,'index']);
Route::post('/pemasok/store',[C_pemasok::class,'store']);
Route::post('/pemasok/update/{id}',[C_pemasok::class,'update']);
//pengadaan
Route::get('/pengadaan',[C_pengadaan::class,'index']);
Route::post('/pengadaan/store',[C_pengadaan::class,'store']);
Route::post('/pengadaan/update/{id}',[C_pengadaan::class,'update']);
Route::post('/pengadaan/detail/store/{id}',[C_pengadaan::class,'storeDetail']);
Route::post('/pengadaan/detail/update/{id}/{id2}',[C_pengadaan::class,'updateDetail']);

//laporan
Route::get('/laporan',[C_laporan::class,'index']);
//Route::post('/laporan/store',[C_laporan::class,'store']);
Route::post('/laporan/update/{id}',[C_laporan::class,'update']);



Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
