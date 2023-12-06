<?php

use App\Http\Controllers\ArsipMasukController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('layouts.main');
});

Route::get('/dashboard', [DashboardController::class,  'index']);
//Supplier
Route::get('/supplier', [SupplierController::class, 'index']);
Route::get('/tambah-supplier', [SupplierController::class, 'create']);
Route::post('/post-supplier', [SupplierController::class, 'store']);
Route::get('/edit-supplier/{supplier}', [SupplierController::class, 'edit']);
Route::post('update-supplier/{supplier}', [SupplierController::class, 'update']);
Route::get('/hapus-supplier/{supplier}', [SupplierController::class, 'destroy']);

//Cabang
Route::get('/cabang', [CabangController::class, 'index']);
Route::get('/tambah-cabang', [CabangController::class, 'create']);
Route::post('/post-cabang', [CabangController::class, 'store']);
Route::get('/edit-cabang/{cabang}', [CabangController::class, 'edit']);
Route::post('/update-cabang/{cabang}', [CabangController::class, 'update']);
Route::get('/hapus-cabang/{cabang}', [CabangController::class, 'destroy']);

//kategori
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/tambah-kategori', [KategoriController::class, 'create']);
Route::post('/post-kategori', [KategoriController::class, 'store']);
Route::get('/edit-kategori/{kategori}', [KategoriController::class, 'edit']);
Route::post('/update-kategori/{kategori}', [KategoriController::class, 'update']);
Route::get('/hapus-kategori/{kategori}', [KategoriController::class, 'destroy']);

//Barang
Route::get('/barang', [BarangController::class, 'index']);
Route::get('/tambah-barang', [BarangController::class, 'create']);
Route::post('/post-barang', [BarangController::class, 'store']);
Route::get('/detail-barang/{barang}', [BarangController::class, 'show']);
Route::get('/edit-barang/{barang}', [BarangController::class, 'edit']);
Route::post('/update-barang/{barang}', [BarangController::class, 'update']);
Route::get('/hapus-barang/{barang}', [BarangController::class, 'destroy']);

//Barang Masuk
Route::controller(BarangMasukController::class)->group(function () {
    Route::get('/barang-masuk', 'index');
    Route::get('/daftar-detail/{params}', 'listDetailItem');
    Route::get('/pilih-sumber-barang', 'createCabangOrSupplier');
    Route::get('/tambah-barang-masuk', 'create');
    Route::post('/post-barang-masuk', 'store');
    Route::get('/detail-barang-masuk/{barangMasuk}', 'show');
    Route::get('/edit-barang-masuk/{barangMasuk}', 'edit');
    Route::post('/update-barang-masuk/{barangMasuk}', 'update');
    Route::get('/hapus-barang-masuk/{barangMasuk}', 'destroy');
});

Route::controller(ArsipMasukController::class)->group(function () {
    Route::get('arsip-masuk', 'index');
    Route::post('arsip-masuk', 'index');
    Route::post('post-arsip-masuk', 'store');
    Route::get('detail-arsip-masuk/{barangMasuk}', 'detailArsip');
});

//Barang Keluar
Route::controller(BarangKeluarController::class)->group(function () {
    Route::get('/barang-keluar', 'index');
    Route::get('/tambah-barang-keluar', 'create');
    Route::post('/post-barang-keluar', 'store');
    Route::get('/edit-barang-keluar/{barangKeluar}', 'edit');
    Route::post('/update-barang-keluar/{barangKeluar}', 'update');
    Route::get('/hapus-barang-keluar/{barangKeluar}', 'destroy');
});

//Users Management

Route::controller(UserController::class)->group(function () {
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
