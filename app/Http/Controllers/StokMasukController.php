<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use App\Models\StokMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokMasukController extends Controller
{
    // Halaman stok masuk
    public function index()
    {
        $barang = Barang::with('category')
            ->orderBy('nama_barang')
            ->get();

        $categories = Category::all();

        return view('stok_masuk.index', compact(
            'barang',
            'categories'
        ));
    }

    // Input data barang baru
    public function storeBarang(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:categories,id',
            'kode_barang' => 'required|string|max:20|unique:barang,kode_barang',
            'nama_barang' => 'required|string|max:100',
            'satuan' => 'required|string|max:20',
            'stok' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($request) {

            Barang::create([
                'kategori_id' => $request->kategori_id,
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'satuan' => $request->satuan,
                'stok' => $request->stok,
            ]);
        });

        return redirect()
            ->route('stok-masuk.index')
            ->with('success', 'Data barang berhasil ditambahkan.');
    }

    // Tambah stok barang yang sudah ada
    public function tambahStok(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {

            $barang = Barang::lockForUpdate()
                ->findOrFail($request->barang_id);

            StokMasuk::create([
                'barang_id' => $barang->id,
                'user_id' => auth()->id(),
                'jumlah' => $request->jumlah,
                'keterangan' => $request->keterangan,
            ]);

            $barang->increment('stok', $request->jumlah);
        });

        return redirect()
            ->route('stok-masuk.index')
            ->with('success', 'Stok berhasil ditambahkan.');
    }
}