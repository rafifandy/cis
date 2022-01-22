<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_barang;
use App\Http\Controllers\C_pelanggan;
use App\Http\Controllers\C_penjualan;

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
Route::get('/penjualan/cetak/{id}',[C_penjualan::class,'cetak']);

Route::get('/penjualan/n',[C_penjualan::class,'index2']);


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
