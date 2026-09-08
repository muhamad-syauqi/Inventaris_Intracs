<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokMasuk;
use App\Models\StokKeluar;

class TeknisiDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $totalBarang = Barang::count();

        $totalStok = Barang::sum('stok');

        $stokMasukSaya = StokMasuk::where('user_id', $userId)
            ->sum('jumlah');

        $stokKeluarSaya = StokKeluar::where('user_id', $userId)
            ->sum('jumlah');


        // Stok masuk terbaru
        $masuk = StokMasuk::with('barang')
            ->where('user_id', $userId)
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($item) {
                $item->jenis = 'Stok Masuk';
                return $item;
            });


        // Stok keluar terbaru
        $keluar = StokKeluar::with('barang')
            ->where('user_id', $userId)
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($item) {
                $item->jenis = 'Stok Keluar';
                return $item;
            });


        // Gabungkan aktivitas
        $aktivitasSaya = $masuk
            ->concat($keluar)
            ->sortByDesc('created_at')
            ->take(10)
            ->values();


        return view('teknisi.dashboard', compact(
            'totalBarang',
            'totalStok',
            'stokMasukSaya',
            'stokKeluarSaya',
            'aktivitasSaya'
        ));
    }
}