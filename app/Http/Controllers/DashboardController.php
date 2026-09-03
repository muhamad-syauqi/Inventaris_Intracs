<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokMasuk;
use App\Models\StokKeluar;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();

        $totalStok = Barang::sum('stok');

        $totalStokMasuk = StokMasuk::sum('jumlah');

        $totalStokKeluar = StokKeluar::sum('jumlah');

        $stokTerbaru = StokMasuk::with('barang')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBarang',
            'totalStok',
            'totalStokMasuk',
            'totalStokKeluar',
            'stokMasukTerbaru'
        ));
    }
}
