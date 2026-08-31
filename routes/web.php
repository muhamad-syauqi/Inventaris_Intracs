<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokMasukController;
use App\Http\Controllers\StokKeluarController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Barang
|--------------------------------------------------------------------------
*/

Route::resource('barang', BarangController::class);


/*
|--------------------------------------------------------------------------
| Stok Masuk
|--------------------------------------------------------------------------
*/

// Halaman stok masuk
Route::get('/stok-masuk', [StokMasukController::class, 'index'])
    ->name('stok-masuk.index');

// Input data barang
Route::post('/stok-masuk/barang', [StokMasukController::class, 'storeBarang'])
    ->name('stok-masuk.store-barang');

// Tambah stok barang
Route::post('/stok-masuk/tambah', [StokMasukController::class, 'tambahStok'])
    ->name('stok-masuk.tambah');


/*
|--------------------------------------------------------------------------
| Stok Keluar
|--------------------------------------------------------------------------
*/

// Halaman stok keluar
Route::get('/stok-keluar', [StokKeluarController::class, 'index'])
    ->name('stok-keluar.index');

// Proses mengeluarkan stok
Route::post('/stok-keluar', [StokKeluarController::class, 'store'])
    ->name('stok-keluar.store');

// Data/riwayat stok keluar
Route::get('/stok-keluar/data', [StokKeluarController::class, 'data'])
    ->name('stok-keluar.data');


/*
|--------------------------------------------------------------------------
| Laporan
|--------------------------------------------------------------------------
*/

Route::get('/laporan', [LaporanController::class, 'index'])
    ->name('laporan.index');