<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokKeluarController extends Controller
{
    // Menampilkan daftar barang yang tersedia
    public function index()
    {
        $barang = Barang::orderBy('nama_barang')->get();

        $query = StokKeluar::with(['barang', 'user'])
            ->latest();

        // Teknisi hanya melihat transaksi miliknya
        if (auth()->user()->role === 'teknisi') {
            $query->where('user_id', auth()->id());
        }

        $stokKeluar = $query->paginate(10);

        return view('Stok_Keluar.index', compact(
            'barang',
            'stokKeluar'
        ));
    }
    public function keluarkan($id)
    {
        $barang = Barang::findOrFail($id);

        return view('stok_keluar.keluarkan', compact('barang'));
    }

    // Mengeluarkan stok
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {

            $barang = Barang::lockForUpdate()
                ->findOrFail($request->barang_id);

            // Mengecek stok
            if ($barang->stok < $request->jumlah) {
                abort(
                    redirect()
                        ->route('stok-keluar.index')
                        ->with('error', 'Stok tidak mencukupi.')
                );
            }

            // Simpan transaksi
            StokKeluar::create([
                'barang_id' => $barang->id,
                'user_id' => auth()->id(),
                'jumlah' => $request->jumlah,
                'keterangan' => $request->keterangan,
            ]);

            // Kurangi stok
            $barang->decrement('stok', $request->jumlah);
        });

        return redirect()
            ->route('stok-keluar.index')
            ->with('success', 'Stok berhasil dikeluarkan.');
    }

    // Data stok keluar
    public function data()
    {
        $stokKeluar = StokKeluar::with([
            'barang',
            'user'
        ])
        ->latest()
        ->paginate(10);

        return view(
            'stok_keluar.data',
            compact('stokKeluar')
        );
    }
}