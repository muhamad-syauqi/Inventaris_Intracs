<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeknisiDashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokMasukController;
use App\Http\Controllers\StokKeluarController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


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
| Halaman yang Wajib Login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // ================= ADMIN =================

    Route::middleware('role:admin')->group(function () {

        Route::get('/admin/dashboard',[DashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::resource('barang', BarangController::class);

        Route::get('/admin/riwayat-stok-masuk',[LaporanController::class, 'riwayatStokMasuk'])
            ->name('admin.riwayat-stok-masuk');

        Route::get('/admin/riwayat-stok-keluar',[LaporanController::class, 'riwayatStokKeluar'])
            ->name('admin.riwayat-stok-keluar');
    });


    // ================= TEKNISI =================

    Route::middleware('role:teknisi')->group(function () {

        Route::get('/teknisi/dashboard', [TeknisiDashboardController::class, 'index'])
            ->name('teknisi.dashboard');
    });


    // ================= ADMIN + TEKNISI =================

    Route::get('/stok-masuk', [StokMasukController::class, 'index'])
        ->name('stok-masuk.index');

    Route::get('/stok-masuk/input-barang', [StokMasukController::class, 'inputBarang'])
        ->name('stok-masuk.input-barang');

    Route::post('/stok-masuk/barang', [StokMasukController::class, 'storeBarang'])
        ->name('stok-masuk.store-barang');

    Route::get('/stok-masuk/tambah-stok', [StokMasukController::class, 'tambahStokPage'])
        ->name('stok-masuk.tambah-stok');

    Route::post('/stok-masuk/tambah', [StokMasukController::class, 'tambahStok'])
        ->name('stok-masuk.tambah');


    Route::get('/stok-keluar', [StokKeluarController::class, 'index'])
        ->name('stok-keluar.index');

    Route::get('/stok-keluar/keluarkan/{id}', [StokKeluarController::class, 'keluarkan'])
        ->name('stok-keluar.keluarkan');

    Route::post('/stok-keluar', [StokKeluarController::class, 'store'])
        ->name('stok-keluar.store');

    Route::get('/stok-keluar/data', [StokKeluarController::class, 'data'])
        ->name('stok-keluar.data');
});