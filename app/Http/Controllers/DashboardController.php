<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokMasuk;
use App\Models\StokKeluar;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $totalBarang = Barang::count();

        $totalStok = Barang::sum('stok');

        $totalStokMasuk = StokMasuk::sum('jumlah');

        $totalStokKeluar = StokKeluar::sum('jumlah');


        // ==========================================
        // GRAFIK STOK 6 BULAN TERAKHIR
        // ==========================================

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
                'bulan' => $tanggal->format('M Y'),
                'masuk' => $masuk,
                'keluar' => $keluar,
            ]);
        }


        // ==========================================
        // AKTIVITAS TERBARU SEMUA TEKNISI
        // ==========================================

        $stokMasuk = StokMasuk::with([
            'barang',
            'user'
        ])
        ->latest()
        ->take(10)
        ->get()
        ->map(function ($item) {

            $item->jenis = 'Stok Masuk';
            $item->tanggal = $item->created_at;

            return $item;
        });


        $stokKeluar = StokKeluar::with([
            'barang',
            'user'
        ])
        ->latest()
        ->take(10)
        ->get()
        ->map(function ($item) {

            $item->jenis = 'Stok Keluar';
            $item->tanggal = $item->created_at;

            return $item;
        });


        $aktivitas = $stokMasuk
            ->concat($stokKeluar)
            ->sortByDesc('tanggal')
            ->take(10)
            ->values();


        // ==========================================
        // PIE CHART BARANG MASUK BULAN INI
        // ==========================================

        $pieBarang = StokMasuk::with('barang')
            ->whereMonth(
                'created_at',
                now()->month
            )
            ->whereYear(
                'created_at',
                now()->year
            )
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