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
        $query = StokMasuk::with(['barang', 'user'])
            ->latest();

        // Teknisi hanya melihat data yang dia input sendiri
        if (auth()->user()->role === 'teknisi') {
            $query->where('user_id', auth()->id());
        }

        $stokMasuk = $query->paginate(10);

        return view('stok_masuk.index', compact('stokMasuk'));
    }

    public function inputBarang()
{
    $categories = Category::orderBy('nama_kategori')->get();

    return view('stok_masuk.input-barang', compact('categories'));
}

public function tambahStokPage()
{
    $barang = Barang::orderBy('nama_barang')->get();

    return view('stok_masuk.tambah-stok', compact('barang'));
}

    // Input data barang baru
    public function storeBarang(Request $request)
{
    $request->validate([
        'kategori_id' => 'required|exists:categories,id',
        'kode_barang' => 'required|string|max:20|unique:barang,kode_barang',
        'nama_barang' => 'required|string|max:255',
        'satuan' => 'required|string|max:50',
        'stok' => 'required|integer|min:1',

        'nomor_do' => 'required|string|max:100',
        'tanggal_request' => 'required|date',
        'nama_request' => 'required|string|max:150',

        'keterangan' => 'nullable|string',
    ]);

    // Simpan barang
    $barang = Barang::create([
        'kategori_id' => $request->kategori_id,
        'kode_barang' => $request->kode_barang,
        'nama_barang' => $request->nama_barang,
        'satuan' => $request->satuan,
        'stok' => $request->stok,
    ]);

    StokMasuk::create([
        'barang_id' => $barang->id,
        'user_id' => auth()->id(),
        'jumlah' => $request->stok,

        'nomor_do' => $request->nomor_do,
        'tanggal_request' => $request->tanggal_request,
        'nama_request' => $request->nama_request,

        'keterangan' => $request->keterangan ?? 'Input data barang baru',
    ]);

    return redirect()
        ->route('stok-masuk.index')
        ->with('success', 'Data barang berhasil ditambahkan dan tercatat sebagai stok masuk.');
}
    // Tambah stok barang yang sudah ada
    public function tambahStok(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',

            'nomor_do' => 'required|string|max:100',
            'tanggal_request' => 'required|date',
            'nama_request' => 'required|string|max:150',

            'keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {

            $barang = Barang::lockForUpdate()
                ->findOrFail($request->barang_id);

            StokMasuk::create([
            'barang_id' => $barang->id,
            'user_id' => auth()->id(),
            'jumlah' => $request->jumlah,

            'nomor_do' => $request->nomor_do,
            'tanggal_request' => $request->tanggal_request,
            'nama_request' => $request->nama_request,

            'keterangan' => $request->keterangan,
        ]);

            $barang->increment('stok', $request->jumlah);
        });

        return redirect()
            ->route('stok-masuk.index')
            ->with('success', 'Stok berhasil ditambahkan.');
    }
}