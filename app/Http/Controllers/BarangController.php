<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Menampilkan daftar barang
    public function index(Request $request)
    {
        $query = Barang::with('category');

        // Pencarian
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
            });
        }

        // Filter kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $barang = $query->latest()->paginate(10);

        $categories = Category::all();

        return view('barang.index', compact(
            'barang',
            'categories'
        ));
    }

    // Form tambah barang
    public function create()
    {
        $categories = Category::all();

        return view('barang.create', compact('categories'));
    }

    // Menyimpan barang baru
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:categories,id',
            'kode_barang' => 'required|string|max:20|unique:barang,kode_barang',
            'nama_barang' => 'required|string|max:100',
            'satuan' => 'required|string|max:20',
            'stok' => 'required|integer|min:0',
        ]);

        Barang::create([
            'kategori_id' => $request->kategori_id,
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'satuan' => $request->satuan,
            'stok' => $request->stok,
        ]);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Data barang berhasil ditambahkan.');
    }

    // Menampilkan detail barang
    public function show(Barang $barang)
    {
        $barang->load('category');

        return view('barang.show', compact('barang'));
    }

    // Form edit barang
    public function edit(Barang $barang)
    {
        $categories = Category::all();

        return view('barang.edit', compact(
            'barang',
            'categories'
        ));
    }

    // Update barang
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'kategori_id' => 'required|exists:categories,id',
            'kode_barang' => 'required|string|max:20|unique:barang,kode_barang,' . $barang->id,
            'nama_barang' => 'required|string|max:100',
            'satuan' => 'required|string|max:20',
            'stok' => 'required|integer|min:0',
        ]);

        $barang->update([
            'kategori_id' => $request->kategori_id,
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'satuan' => $request->satuan,
            'stok' => $request->stok,
        ]);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Data barang berhasil diperbarui.');
    }

    // Hapus barang
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()
            ->route('barang.index')
            ->with('success', 'Data barang berhasil dihapus.');
    }
}