<?php

use App\Http\Controllers\TransaksiController;
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

Route::get('/', [TransaksiController::class, 'index']);
Route::get('/transaksi/create', [TransaksiController::class, 'create']);
Route::get('/fetchBarang', [TransaksiController::class, 'fetchBarang']);
Route::post('/transaksi', [TransaksiController::class, 'store']);
Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit']);
