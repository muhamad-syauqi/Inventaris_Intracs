<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokMasuk;
use App\Models\StokKeluar;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    // =========================
    // LAPORAN BARANG
    // =========================

    public function barang(Request $request)
    {
        $query = Barang::with('category');

        if ($request->filled('dari')) {
            $query->whereDate('created_at', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('created_at', '<=', $request->sampai);
        }

        $barang = $query
            ->orderBy('nama_barang')
            ->get();

        return view('laporan.barang', compact('barang'));
    }


    // =========================
    // LAPORAN STOK MASUK
    // =========================

    public function stokMasuk(Request $request)
    {
        $query = StokMasuk::with('barang');

        if ($request->filled('dari')) {
            $query->whereDate('created_at', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('created_at', '<=', $request->sampai);
        }

        $stokMasuk = $query
            ->latest()
            ->get();

        return view(
            'laporan.stok-masuk',
            compact('stokMasuk')
        );
    }


    // =========================
    // LAPORAN STOK KELUAR
    // =========================

    public function stokKeluar(Request $request)
    {
        $query = StokKeluar::with('barang');

        if ($request->filled('dari')) {
            $query->whereDate('created_at', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('created_at', '<=', $request->sampai);
        }

        $stokKeluar = $query
            ->latest()
            ->get();

        return view(
            'laporan.stok-keluar',
            compact('stokKeluar')
        );
    }

    public function riwayatStokMasuk()
        {
            $stokMasuk = StokMasuk::with([
                'barang.category',
                'user'
            ])
            ->latest()
            ->paginate(15);

            return view(
                'admin.riwayat-stok-masuk',
                compact('stokMasuk')
            );
        }

public function riwayatStokKeluar()
    {
        $stokKeluar = StokKeluar::with(['barang', 'user'])
            ->latest()
            ->paginate(15);

        return view('admin.riwayat-stok-keluar', compact('stokKeluar'));
    }


    // =========================
    // EXPORT BARANG
    // =========================

    public function exportBarang(Request $request)
    {
        $query = Barang::with('category');

        if ($request->filled('dari')) {
            $query->whereDate('created_at', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('created_at', '<=', $request->sampai);
        }

        $barang = $query
            ->orderBy('nama_barang')
            ->get();

        $filename = 'laporan-barang.csv';

        $handle = fopen('php://temp', 'w');

        fputcsv($handle, [
            'Kode Barang',
            'Nama Barang',
            'Kategori',
            'Satuan',
            'Stok'
        ]);

        foreach ($barang as $item) {

            fputcsv($handle, [
                $item->kode_barang,
                $item->nama_barang,
                $item->category->nama_kategori ?? '-',
                $item->satuan,
                $item->stok
            ]);
        }

        rewind($handle);

        return response()->streamDownload(
            function () use ($handle) {
                fpassthru($handle);
            },
            $filename,
            [
                'Content-Type' => 'text/csv',
            ]
        );
    }


    // =========================
    // EXPORT STOK MASUK
    // =========================

    public function exportStokMasuk(Request $request)
    {
        $query = StokMasuk::with('barang');

        if ($request->filled('dari')) {
            $query->whereDate('created_at', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('created_at', '<=', $request->sampai);
        }

        $data = $query->latest()->get();

        $handle = fopen('php://temp', 'w');

        fputcsv($handle, [
            'Kode Barang',
            'Nama Barang',
            'Jumlah',
            'Keterangan',
            'Tanggal'
        ]);

        foreach ($data as $item) {

            fputcsv($handle, [
                $item->barang->kode_barang ?? '-',
                $item->barang->nama_barang ?? '-',
                $item->jumlah,
                $item->keterangan ?? '-',
                $item->created_at->format('d/m/Y H:i')
            ]);
        }

        rewind($handle);

        return response()->streamDownload(
            function () use ($handle) {
                fpassthru($handle);
            },
            'laporan-stok-masuk.csv',
            [
                'Content-Type' => 'text/csv',
            ]
        );
    }


    // =========================
    // EXPORT STOK KELUAR
    // =========================

    public function exportStokKeluar(Request $request)
    {
        $query = StokKeluar::with('barang');

        if ($request->filled('dari')) {
            $query->whereDate('created_at', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('created_at', '<=', $request->sampai);
        }

        $data = $query->latest()->get();

        $handle = fopen('php://temp', 'w');

        fputcsv($handle, [
            'Kode Barang',
            'Nama Barang',
            'Jumlah',
            'Keterangan',
            'Tanggal'
        ]);

        foreach ($data as $item) {

            fputcsv($handle, [
                $item->barang->kode_barang ?? '-',
                $item->barang->nama_barang ?? '-',
                $item->jumlah,
                $item->keterangan ?? '-',
                $item->created_at->format('d/m/Y H:i')
            ]);
        }

        rewind($handle);

        return response()->streamDownload(
            function () use ($handle) {
                fpassthru($handle);
            },
            'laporan-stok-keluar.csv',
            [
                'Content-Type' => 'text/csv',
            ]
        );
    }
}