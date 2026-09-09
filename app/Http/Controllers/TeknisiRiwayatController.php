<?php

namespace App\Http\Controllers;

use App\Models\StokMasuk;
use App\Models\StokKeluar;

class TeknisiRiwayatController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $stokMasuk = StokMasuk::with('barang')
            ->where('user_id', $userId)
            ->latest()
            ->get()
            ->map(function ($item) {
                $item->jenis = 'Stok Masuk';
                $item->tanggal = $item->created_at;

                return $item;
            });

        $stokKeluar = StokKeluar::with('barang')
            ->where('user_id', $userId)
            ->latest()
            ->get()
            ->map(function ($item) {
                $item->jenis = 'Stok Keluar';
                $item->tanggal = $item->created_at;

                return $item;
            });

        $riwayat = $stokMasuk
            ->concat($stokKeluar)
            ->sortByDesc('tanggal')
            ->values();

        return view('teknisi.riwayat', compact('riwayat'));
    }
}