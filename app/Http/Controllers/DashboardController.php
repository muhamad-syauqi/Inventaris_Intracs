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

        // Data grafik 6 bulan terakhir
        $grafik = collect();

        for ($i = 5; $i >= 0; $i--) {

            $tanggal = now()->subMonths($i);

            $masuk = StokMasuk::whereYear(
                'created_at',
                $tanggal->year
            )
            ->whereMonth(
                'created_at',
                $tanggal->month
            )
            ->sum('jumlah');

            $keluar = StokKeluar::whereYear(
                'created_at',
                $tanggal->year
            )
            ->whereMonth(
                'created_at',
                $tanggal->month
            )
            ->sum('jumlah');

            $grafik->push([
                'bulan' => $tanggal->translatedFormat('M Y'),
                'masuk' => $masuk,
                'keluar' => $keluar,
            ]);
        }

        // Aktivitas terbaru dari stok masuk dan stok keluar
        $stokMasuk = StokMasuk::with(['barang', 'user'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'jenis' => 'Stok Masuk',
                    'barang' => $item->barang->nama_barang ?? '-',
                    'jumlah' => $item->jumlah,
                    'user' => $item->user->name ?? '-',
                    'tanggal' => $item->created_at,
                ];
            });

        $stokKeluar = StokKeluar::with(['barang', 'user'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'jenis' => 'Stok Keluar',
                    'barang' => $item->barang->nama_barang ?? '-',
                    'jumlah' => $item->jumlah,
                    'user' => $item->user->name ?? '-',
                    'tanggal' => $item->created_at,
                ];
            });

        $aktivitas = $stokMasuk
            ->concat($stokKeluar)
            ->sortByDesc('tanggal')
            ->take(10);

        return view('dashboard', compact(
            'totalBarang',
            'totalStok',
            'totalStokMasuk',
            'totalStokKeluar',
            'grafik',
            'aktivitas'
        ));
    }
}