<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
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
Route::get('/edit-barang/{barang}', [BarangController::class, 'edit']);
Route::post('/update-barang/{barang}', [BarangController::class, 'update']);
Route::get('/hapus-barang/{barang}', [BarangController::class, 'destroy']);
