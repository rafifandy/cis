<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_barang;
use App\Http\Controllers\C_pelanggan;
use App\Http\Controllers\C_penjualan;
use App\Http\Controllers\C_pengadaan;
use App\Http\Controllers\C_rekap;

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
    return view('index');
});
Route::get('/home', function () {
    return view('index');
});

//barang
Route::get('/barang',[C_barang::class,'index']);
Route::post('/barang/store',[C_barang::class,'store']);
Route::post('/barang/update/{id}',[C_barang::class,'update']);

//pelanggan
Route::get('/pelanggan',[C_pelanggan::class,'index']);
Route::post('/pelanggan/store',[C_pelanggan::class,'store']);
Route::post('/pelanggan/update/{id}',[C_pelanggan::class,'update']);

//penjualan
Route::get('/penjualan',[C_penjualan::class,'index']);
Route::post('/penjualan/store',[C_penjualan::class,'store']);
Route::post('/penjualan/update/{id}',[C_penjualan::class,'update']);
Route::get('/penjualan/cetak/{id}',[C_penjualan::class,'cetak']);
Route::post('/penjualan/detail/store/{id}',[C_penjualan::class,'storeDetail']);
Route::post('/penjualan/detail/update/{id}/{id2}',[C_penjualan::class,'updateDetail']);

Route::get('/penjualan/n',[C_penjualan::class,'index2']);

//pengadaan
Route::get('/pengadaan',[C_pengadaan::class,'index']);

//rekap
Route::get('/rekap',[C_rekap::class,'index']);
Route::post('/rekap/store',[C_rekap::class,'store']);
Route::post('/rekap/update/{id}',[C_rekap::class,'update']);



Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
