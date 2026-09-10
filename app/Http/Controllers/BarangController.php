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
        'kode_barang' => 'required|string|max:50|unique:barang,kode_barang',
        'nama_barang' => 'required|string|max:255|unique:barang,nama_barang',
        'kategori_id' => 'required|exists:categories,id',
        'satuan' => 'required|string|max:50',
    ], [
        'kode_barang.unique' => 'Data barang sudah tersedia. Silakan menambah data barang dengan kode barang yang berbeda.',
        'nama_barang.unique' => 'Data barang sudah tersedia. Silakan menambah data barang dengan nama barang yang berbeda.',
    ]);

    Barang::create([
        'kode_barang' => $request->kode_barang,
        'nama_barang' => $request->nama_barang,
        'kategori_id' => $request->kategori_id,
        'satuan' => $request->satuan,
        'stok' => 0,
    ]);

    return redirect()
        ->route('stok-masuk.input-barang')
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
   public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'kode_barang' => 'required|string|max:50|unique:barang,kode_barang,' . $barang->id,
            'nama_barang' => 'required|string|max:255|unique:barang,nama_barang,' . $barang->id,
            'kategori_id' => 'required|exists:category,id',
            'satuan' => 'required|string|max:50',
        ], [
            'kode_barang.unique' => 'Kode barang sudah digunakan oleh barang lain.',
            'nama_barang.unique' => 'Nama barang sudah digunakan oleh barang lain.',
        ]);

        $barang->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'satuan' => $request->satuan,
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