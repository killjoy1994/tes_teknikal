<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\TransaksiController;
use App\Models\Barang;
use App\Models\Transaksi;
use Database\Seeders\TransaksiSeeder;
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

Route::controller(TransaksiController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/search-barang', 'search');
    Route::get('/sort-transaksi', 'sort');
    Route::get('/transaksi/create', 'create');
    Route::get('/fetchBarang', 'fetchBarang');
    Route::post('/transaksi', 'store');
    Route::get('/transaksi/{id}/edit', 'edit');
    Route::put('/transaksi/{id}', 'update');
    Route::get('/transaksi/{id}/delete', 'destroy');
});

Route::controller(JenisBarangController::class)->group(function () {
    Route::get('/jenis-barang', 'index');
    Route::get('/jenis-barang/create', 'create');
    Route::post('/jenis-barang', 'store');
    Route::get('/jenis-barang/{id}/edit', 'edit');
    Route::put('/jenis-barang/{id}', 'update');
    Route::get('/jenis-barang/{id}/delete', 'destroy');
});

Route::controller(BarangController::class)->group(function () {
    Route::get('/barang', 'index');
    Route::get('/barang/create', 'create');
    Route::post('/barang', 'store');
    Route::get('/barang/{id}/edit', 'edit');
    Route::put('/barang/{id}', 'update');
    Route::get('/barang/{id}/delete', 'destroy');
});
