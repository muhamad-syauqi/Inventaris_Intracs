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

        $pieBarang = StokMasuk::with('barang')
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->get()
        ->groupBy(function ($item) {
            return $item->barang->nama_barang;
        })
        ->map(function ($items) {
            return $items->sum('jumlah');
        })
        ->map(function ($jumlah, $nama) {
            return [
                'nama' => $nama,
                'jumlah' => $jumlah,
            ];
        })
    ->values();
        // Grafik 6 bulan terakhir
        $grafik = collect();

        for ($i = 5; $i >= 0; $i--) {

            $tanggal = now()->subMonths($i);

            $grafik->push([
                'bulan' => $tanggal->format('M Y'),

                'masuk' => StokMasuk::whereYear(
                    'created_at',
                    $tanggal->year
                )
                ->whereMonth(
                    'created_at',
                    $tanggal->month
                )
                ->sum('jumlah'),

                'keluar' => StokKeluar::whereYear(
                    'created_at',
                    $tanggal->year
                )
                ->whereMonth(
                    'created_at',
                    $tanggal->month
                )
                ->sum('jumlah'),
            ]);
        }

        // Stok masuk
        $stokMasuk = StokMasuk::with(['barang', 'user'])
            ->latest()
            ->take(10)
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

        // Stok keluar
        $stokKeluar = StokKeluar::with(['barang', 'user'])
            ->latest()
            ->take(10)
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

        // Gabungkan aktivitas
        $aktivitas = $stokMasuk
            ->concat($stokKeluar)
            ->sortByDesc('tanggal')
            ->take(10)
            ->values();

        return view('Dashboard', compact(
            'totalBarang',
            'totalStok',
            'totalStokMasuk',
            'totalStokKeluar',
            'grafik',
            'aktivitas',
            'pieBarang'
        ));
    }
}