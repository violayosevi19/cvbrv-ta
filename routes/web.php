<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\JenisprodukController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\DetailPesananController;
use App\Http\Controllers\FakturController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PegawaiHomeController;
use App\Http\Controllers\DetailpesananHomeController;
use App\Http\Controllers\FakturHomeController;
use App\Http\Controllers\JenisprodukHomeController;
use App\Http\Controllers\PembayaranHomeController;
use App\Http\Controllers\PenjualanHomeController;
use App\Http\Controllers\ProdukHomeController;
use App\Http\Controllers\SupplierHomeController;
use App\Http\Controllers\TokoHomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;


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
    return view('dashboard.dash.dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard.dash.dashboard');
})->Middleware('auth');

//front end

Route::resource('/pegawai-dash',PegawaiController::class);

Route::resource('/produk-dash',ProdukController::class);

Route::resource('/jenisproduk-dash',JenisprodukController::class);

Route::resource('/toko-dash',TokoController::class);

Route::resource('/detailpesanan-dash',DetailPesananController::class);

Route::resource('/faktur-dash',FakturController::class);

Route::resource('/penjualan-dash',PenjualanController::class);

Route::resource('/pembayaran-dash',PembayaranController::class);

Route::resource('/supplier-dash',SupplierController::class);

//backend


Route::get('/home',[HomeController::class,'index']);

Route::get('/pegawai-home',[PegawaiHomeController::class,'index']);

Route::get('/toko-home',[TokoHomeController::class,'index']);

Route::get('/detailpesanan-home',[DetailpesananHomeController::class,'index']);

Route::get('/faktur-home',[FakturHomeController::class,'index']);

Route::get('/jenisproduk-home',[JenisprodukHomeController::class,'index']);

Route::get('/pembayaran-home',[PembayaranHomeController::class,'index']);

Route::get('/penjualan-home',[PenjualanHomeController::class,'index']);

Route::get('/produk-home',[ProdukHomeController::class,'index']);

Route::get('/supplier-home',[SupplierHomeController::class,'index']);

//login logout
Route::get('/login',[LoginController::class,'login'])->name('login')->Middleware('guest');

Route::post('/login',[LoginController::class,'authenticate']);

Route::get('/logout',[LoginController::class,'logout']);




