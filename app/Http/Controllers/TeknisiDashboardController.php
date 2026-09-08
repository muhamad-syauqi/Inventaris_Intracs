<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokMasuk;
use App\Models\StokKeluar;

class TeknisiDashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalStok = Barang::sum('stok');

        $stokMasukSaya = StokMasuk::where('user_id', auth()->id())
            ->sum('jumlah');

        $stokKeluarSaya = StokKeluar::where('user_id', auth()->id())
            ->sum('jumlah');

        $aktivitasSaya = StokMasuk::with('barang')
            ->where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        return view('teknisi.dashboard', compact(
            'totalBarang',
            'totalStok',
            'stokMasukSaya',
            'stokKeluarSaya',
            'aktivitasSaya'
        ));
    }
}