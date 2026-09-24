<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\StokMasukController;
use App\Http\Controllers\StokKeluarController;
use App\Http\Controllers\TeknisiDashboardController;
use App\Http\Controllers\TeknisiRiwayatController;


/*
|--------------------------------------------------------------------------
| Halaman Awal
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicDashboardController::class, 'index'])
    ->name('public.dashboard');


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

Route::middleware('auth')->group(function () {

    Route::get('/ganti-password',
        [PasswordController::class, 'edit']
    )->name('password.edit');

    Route::put('/ganti-password',
        [PasswordController::class, 'update']
    )->name('password.update');

});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard',
        [DashboardController::class, 'index']
    )->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | Barang
    |--------------------------------------------------------------------------
    */

    // Daftar barang
    Route::get('/barang',
        [BarangController::class, 'index']
    )->name('barang.index');

    // Form tambah barang
    Route::get('/barang/create',
        [BarangController::class, 'create']
    )->name('barang.create');

    // Simpan barang
    Route::post('/barang',
        [BarangController::class, 'store']
    )->name('barang.store');

    // Detail barang
    Route::get('/barang/{id}',
        [BarangController::class, 'show']
    )->name('barang.show');

    // Form edit barang
    Route::get('/barang/{id}/edit',
        [BarangController::class, 'edit']
    )->name('barang.edit');

    // Update barang
    Route::put('/barang/{id}',
        [BarangController::class, 'update']
    )->name('barang.update');


    /*
    |--------------------------------------------------------------------------
    | Tambah Stok
    |--------------------------------------------------------------------------
    */

    // Halaman tambah stok
    Route::get('/stok-masuk/tambah-stok',
        [StokMasukController::class, 'tambahStokPage']
    )->name('stok-masuk.tambah-stok');

    // Proses tambah stok
    Route::post('/stok-masuk/tambah',
        [StokMasukController::class, 'tambahStok']
    )->name('stok-masuk.tambah');


    /*
    |--------------------------------------------------------------------------
    | Riwayat Stok Masuk Admin
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/riwayat-stok-masuk',
        [LaporanController::class, 'riwayatStokMasuk']
    )->name('admin.riwayat-stok-masuk');

    Route::get('/admin/riwayat-stok-masuk/excel',
        [LaporanController::class, 'exportStokMasukExcel']
    )->name('admin.riwayat-stok-masuk.excel');

    Route::get('/admin/riwayat-stok-masuk/word',
        [LaporanController::class, 'exportStokMasukWord']
    )->name('admin.riwayat-stok-masuk.word');

    Route::get('/admin/riwayat-stok-masuk/{id}/edit',
        [LaporanController::class, 'editStokMasuk']
    )->name('admin.riwayat-stok-masuk.edit');

    Route::put('/admin/riwayat-stok-masuk/{id}',
        [LaporanController::class, 'updateStokMasuk']
    )->name('admin.riwayat-stok-masuk.update');

    Route::delete('/admin/riwayat-stok-masuk/{id}',
        [LaporanController::class, 'deleteStokMasuk']
    )->name('admin.riwayat-stok-masuk.delete');


    /*
    |--------------------------------------------------------------------------
    | Riwayat Stok Keluar Admin
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/riwayat-stok-keluar',
        [LaporanController::class, 'riwayatStokKeluar']
    )->name('admin.riwayat-stok-keluar');

    Route::get('/admin/riwayat-stok-keluar/excel',
        [LaporanController::class, 'exportStokKeluarExcel']
    )->name('admin.riwayat-stok-keluar.excel');

    Route::get('/admin/riwayat-stok-keluar/word',
        [LaporanController::class, 'exportStokKeluarWord']
    )->name('admin.riwayat-stok-keluar.word');

    Route::get('/admin/riwayat-stok-keluar/{id}/edit',
    [LaporanController::class, 'editStokKeluar']
    )->name('admin.riwayat-stok-keluar.edit');

    Route::put('/admin/riwayat-stok-keluar/{id}',
        [LaporanController::class, 'updateStokKeluar']
    )->name('admin.riwayat-stok-keluar.update');

    Route::delete('/admin/riwayat-stok-keluar/{id}',
        [LaporanController::class, 'deleteStokKeluar']
    )->name('admin.riwayat-stok-keluar.delete');

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
    | Stok Keluar
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


    /*
    |--------------------------------------------------------------------------
    | Riwayat Teknisi
    |--------------------------------------------------------------------------
    */

    Route::get('/teknisi/riwayat',
        [TeknisiRiwayatController::class, 'index']
    )->name('teknisi.riwayat');

});