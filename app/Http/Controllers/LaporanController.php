<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokMasuk;
use App\Models\StokKeluar;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Halaman laporan
    public function index(Request $request)
    {
        // Laporan stok barang
        $barang = Barang::with('category')
            ->orderBy('nama_barang')
            ->paginate(10, ['*'], 'barang_page');

        // Laporan stok masuk
        $stokMasukQuery = StokMasuk::with([
            'barang',
            'user'
        ]);

        // Laporan stok keluar
        $stokKeluarQuery = StokKeluar::with([
            'barang',
            'user'
        ]);

        // Filter tanggal
        if ($request->filled('tanggal_mulai')) {

            $stokMasukQuery->whereDate(
                'created_at',
                '>=',
                $request->tanggal_mulai
            );

            $stokKeluarQuery->whereDate(
                'created_at',
                '>=',
                $request->tanggal_mulai
            );
        }

        if ($request->filled('tanggal_akhir')) {

            $stokMasukQuery->whereDate(
                'created_at',
                '<=',
                $request->tanggal_akhir
            );

            $stokKeluarQuery->whereDate(
                'created_at',
                '<=',
                $request->tanggal_akhir
            );
        }

        // Filter barang
        if ($request->filled('barang_id')) {

            $stokMasukQuery->where(
                'barang_id',
                $request->barang_id
            );

            $stokKeluarQuery->where(
                'barang_id',
                $request->barang_id
            );
        }

        $stokMasuk = $stokMasukQuery
            ->latest()
            ->paginate(10, ['*'], 'masuk_page');

        $stokKeluar = $stokKeluarQuery
            ->latest()
            ->paginate(10, ['*'], 'keluar_page');

        $daftarBarang = Barang::orderBy('nama_barang')->get();

        return view('laporan.index', compact(
            'barang',
            'stokMasuk',
            'stokKeluar',
            'daftarBarang'
        ));
    }
}