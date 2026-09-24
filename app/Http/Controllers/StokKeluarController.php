<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokKeluarController extends Controller
{

    public function index(Request $request)
    {
        // Daftar barang untuk dipilih
        $queryBarang = Barang::orderBy('nama_barang');

        // Pencarian berdasarkan kode atau nama barang
        if ($request->filled('search')) {
            $queryBarang->where(function ($q) use ($request) {
                $q->where('kode_barang', 'like', '%' . $request->search . '%')
                ->orWhere('nama_barang', 'like', '%' . $request->search . '%');
            });
        }

        $barang = $queryBarang
            ->paginate(12)
            ->withQueryString();


        // Riwayat stok keluar
        $queryStokKeluar = StokKeluar::with(['barang', 'user'])
            ->latest();

        // Teknisi hanya melihat transaksi miliknya
        if (auth()->user()->role === 'teknisi') {
            $queryStokKeluar->where('user_id', auth()->id());
        }

        $stokKeluar = $queryStokKeluar
            ->paginate(10, ['*'], 'riwayat_page')
            ->withQueryString();


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

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'gerbang_tol' => 'required|string|max:100',
            'nomor_gardu' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {

            $barang = Barang::lockForUpdate()
                ->findOrFail($request->barang_id);

            if ($barang->stok < $request->jumlah) {
                abort(
                    redirect()
                        ->route('stok-keluar.index')
                        ->with('error', 'Stok tidak mencukupi.')
                );
            }

            StokKeluar::create([
                'barang_id' => $barang->id,
                'user_id' => auth()->id(),
                'jumlah' => $request->jumlah,
                'gerbang_tol' => $request->gerbang_tol,
                'nomor_gardu' => $request->nomor_gardu,
                'keterangan' => $request->keterangan,
            ]);

            $barang->decrement('stok', $request->jumlah);
        });

        return redirect()
            ->route('stok-keluar.index')
            ->with('success', 'Stok berhasil dikeluarkan.');
    }
}