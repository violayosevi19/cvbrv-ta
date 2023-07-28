<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\JenisprodukController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\DetailPesananController;
use App\Http\Controllers\FakturControllerDash;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PegawaiHomeController;
use App\Http\Controllers\SupplierController;
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
use App\Http\Controllers\StockController;
use App\Http\Controllers\SearchingController;
use App\Http\Controllers\GetDataController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\CetakPaperController;
use App\Http\Controllers\ReportController;


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
//     return view('dashboard.dash.dashboard');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard.dash.dashboard');
// })->Middleware('auth');

//route global
Route::get('/',[DashboardController::class,'index'])->Middleware('auth');
Route::get('/dashboard',[DashboardController::class,'index']);
//route group
Route::group(['middleware' => ['auth', 'cekrole:admin,fakturis,manajer penjualan,manajer distribusi,direksi']], function() {
    //front end
    Route::resource('/pegawai-dash',PegawaiController::class);
    Route::resource('/produk-dash',ProdukController::class);
    Route::resource('/jenisproduk-dash',JenisprodukController::class);
    Route::resource('/toko-dash',TokoController::class);
    Route::resource('/detailorderan-dash',DetailPesananController::class);
    Route::resource('/faktur-dash',FakturControllerDash::class);
    Route::resource('/penjualan-dash',PenjualanController::class);
    Route::resource('/pembayaran-dash',PembayaranController::class);
    Route::resource('/supplier-dash',SupplierController::class);
    Route::resource('/barangmasuk-dash',BarangMasukController::class);
    Route::resource('/barangkeluar-dash',BarangKeluarController::class);
    Route::resource('/stock-dash',StockController::class);
    Route::get('/cetak-faktur',function() {
        return view('dashboard.faktur.invoice');
    });
    Route::get('/cetak/{nonota}',[CetakPaperController::class,'index']);
    Route::get('/report-dash',[ReportController::class,'index']);
});

// Route::group(['middleware' => ['auth','cekrole:fakturis']], function() {
//     Route::resource('/produk-dash',ProdukController::class);
//     Route::resource('/jenisproduk-dash',JenisprodukController::class);
//     Route::resource('/toko-dash',TokoController::class);
//     Route::resource('/detailorderan-dash',DetailPesananController::class);
//     Route::resource('/faktur-dash',FakturControllerDash::class);
//     Route::resource('/supplier-dash',SupplierController::class);
//     Route::resource('/barangmasuk-dash',BarangMasukController::class);
//     Route::resource('/stock-dash',StockController::class);
//     Route::get('/cetak-faktur',function() {
//         return view('dashboard.faktur.invoice');
//     });
//     Route::get('/cetak/{nonota}',[CetakPaperController::class,'index']);
// });

// Route::group(['middleware' => ['auth','cekrole:manajer penjualan']], function() {
//     Route::resource('/penjualan-dash',PenjualanController::class);
//     Route::get('/report-dash',[ReportController::class,'index']);
    
// });

// Route::group(['middleware' => ['auth','cekrole:manajer distribusi']], function() {
//     Route::resource('/pegawai-dash',PegawaiController::class);
//     Route::resource('/toko-dash',TokoController::class);
//     Route::resource('/supplier-dash',SupplierController::class);
//     Route::resource('/stock-dash',StockController::class);
// });

// Route::group(['middleware' => ['auth','cekrole:direksi']], function() {
//     Route::resource('/pegawai-dash',PegawaiController::class);
//     Route::resource('/produk-dash',ProdukController::class);
//     Route::resource('/jenisproduk-dash',JenisprodukController::class);
//     Route::resource('/toko-dash',TokoController::class);
//     Route::resource('/detailorderan-dash',DetailPesananController::class);
//     Route::resource('/faktur-dash',FakturControllerDash::class);
//     Route::resource('/penjualan-dash',PenjualanController::class);
//     Route::resource('/pembayaran-dash',PembayaranController::class);
//     Route::resource('/supplier-dash',SupplierController::class);
//     Route::resource('/barangmasuk-dash',BarangMasukController::class);
//     Route::resource('/barangkeluar-dash',BarangKeluarController::class);
//     Route::resource('/stock-dash',StockController::class);
//     Route::get('/cetak-faktur',function() {
//         return view('dashboard.faktur.invoice');
//     });
//     Route::get('/cetak/{nonota}',[CetakPaperController::class,'index']);
//     Route::get('/report-dash',[ReportController::class,'index']);
// });

// mendapatkan data input
Route::get('/get-stock',[SearchingController::class,'searchingStok']);
Route::get('/get-data', [GetDataController::class,'getFaktur']);
Route::get('/get-alamat', [GetDataController::class,'getAlamat']);
Route::get('/get-produk', [GetDataController::class,'getNamaProduk']);
Route::get('/get-jumlah', [GetDataController::class,'getJumlahHargaProduk']);
Route::get('/get-jumlahdetail', [GetDataController::class,'getJumlahHargaDetail']);
Route::get('/get-faktur', [GetDataController::class,'getPenjualan']);

// //front end
// Route::get('/',[DashboardController::class,'index'])->Middleware('auth');
// Route::get('/dashboard',[DashboardController::class,'index']);
// Route::resource('/pegawai-dash',PegawaiController::class);
// Route::resource('/produk-dash',ProdukController::class);
// Route::resource('/jenisproduk-dash',JenisprodukController::class);
// Route::resource('/toko-dash',TokoController::class);
// Route::resource('/detailorderan-dash',DetailPesananController::class);
// Route::resource('/faktur-dash',FakturControllerDash::class);
// Route::resource('/penjualan-dash',PenjualanController::class);
// Route::resource('/pembayaran-dash',PembayaranController::class);
// Route::resource('/supplier-dash',SupplierController::class);
// Route::resource('/barangmasuk-dash',BarangMasukController::class);
// Route::resource('/barangkeluar-dash',BarangKeluarController::class);
// Route::resource('/stock-dash',StockController::class);
// Route::get('/get-stock',[SearchingController::class,'searchingStok']);
// Route::get('/get-data', [GetDataController::class,'getFaktur']);
// Route::get('/get-alamat', [GetDataController::class,'getAlamat']);
// Route::get('/get-produk', [GetDataController::class,'getNamaProduk']);
// Route::get('/get-jumlah', [GetDataController::class,'getJumlahHargaProduk']);
// Route::get('/get-jumlahdetail', [GetDataController::class,'getJumlahHargaDetail']);
// Route::get('/get-faktur', [GetDataController::class,'getPenjualan']);
// Route::get('/cetak-faktur',function() {
//     return view('dashboard.faktur.invoice');
// });
// Route::get('/cetak/{nonota}',[CetakPaperController::class,'index']);
// Route::get('/report-dash',[ReportController::class,'index']);


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




