<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\StokMasukController;
use App\Http\Controllers\StokKeluarController;
use App\Http\Controllers\TeknisiDashboardController;
use App\Http\Controllers\TeknisiRiwayatController;


/*
|--------------------------------------------------------------------------
| Halaman Login
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

    Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard',
        [DashboardController::class, 'index']
    )->name('admin.dashboard');

    Route::resource('barang', BarangController::class)
        ->only(['index', 'show', 'edit', 'update']);

    Route::get('/admin/riwayat-stok-masuk',
        [LaporanController::class, 'riwayatStokMasuk']
    )->name('admin.riwayat-stok-masuk');

    Route::get('/admin/riwayat-stok-masuk/excel',
        [LaporanController::class, 'exportStokMasukExcel']
    )->name('admin.riwayat-stok-masuk.excel');

    Route::get('/admin/riwayat-stok-masuk/word',
        [LaporanController::class, 'exportStokMasukWord']
    )->name('admin.riwayat-stok-masuk.word');


    Route::get('/admin/riwayat-stok-keluar',
        [LaporanController::class, 'riwayatStokKeluar']
    )->name('admin.riwayat-stok-keluar');

    Route::get('/admin/riwayat-stok-keluar/excel',
        [LaporanController::class, 'exportStokKeluarExcel']
    )->name('admin.riwayat-stok-keluar.excel');

    Route::get('/admin/riwayat-stok-keluar/word',
        [LaporanController::class, 'exportStokKeluarWord']
    )->name('admin.riwayat-stok-keluar.word');
});


/*
|--------------------------------------------------------------------------
| TEKNISI
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:teknisi'])->group(function () {

    // Dashboard Teknisi
    Route::get('/teknisi/dashboard',
        [TeknisiDashboardController::class, 'index']
    )->name('teknisi.dashboard');


    /*
    |--------------------------------------------------------------------------
    | STOK MASUK
    |--------------------------------------------------------------------------
    */

   Route::get('/teknisi/riwayat',[TeknisiRiwayatController::class, 'index']
    )->name('teknisi.riwayat');

    Route::get('/stok-masuk',
        [StokMasukController::class, 'index']
    )->name('stok-masuk.index');

    // Input barang baru
    Route::get('/stok-masuk/input-barang',
        [StokMasukController::class, 'inputBarang']
    )->name('stok-masuk.input-barang');

    Route::post('/stok-masuk/barang',
        [StokMasukController::class, 'storeBarang']
    )->name('stok-masuk.store-barang');

    // Tambah stok
    Route::get('/stok-masuk/tambah-stok',
        [StokMasukController::class, 'tambahStokPage']
    )->name('stok-masuk.tambah-stok');

    Route::post('/stok-masuk/tambah',
        [StokMasukController::class, 'tambahStok']
    )->name('stok-masuk.tambah');


    /*
    |--------------------------------------------------------------------------
    | STOK KELUAR
    |--------------------------------------------------------------------------
    */

    Route::get('/stok-keluar',
        [StokKeluarController::class, 'index']
    )->name('stok-keluar.index');

    Route::get('/stok-keluar/keluarkan/{id}',
        [StokKeluarController::class, 'keluarkan']
    )->name('stok-keluar.keluarkan');

    Route::post('/stok-keluar',
        [StokKeluarController::class, 'store']
    )->name('stok-keluar.store');

});