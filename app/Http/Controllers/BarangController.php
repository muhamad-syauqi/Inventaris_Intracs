<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
{
    $query = Barang::with('category');

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('kode_barang', 'like', '%' . $request->search . '%')
              ->orWhere('nama_barang', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->filled('kategori_id')) {
        $query->where('kategori_id', $request->kategori_id);
    }

    $barang = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $categories = Category::whereIn(
        'nama_kategori',
        ['Proyek', 'Maintenance']
    )
    ->orderBy('nama_kategori')
    ->get();

    return view('Barang.index', compact(
        'barang',
        'categories'
    ));
}

    public function create()
    {
        $kategori = Category::whereIn(
            'nama_kategori',
            ['Proyek', 'Maintenance']
        )->orderBy('nama_kategori')->get();

        return view('Barang.create', compact('kategori'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string|max:50|unique:barang,kode_barang',
            'nama_barang' => 'required|string|max:255|unique:barang,nama_barang',
            'kategori_id' => 'required|exists:category,id',
            'satuan' => 'required|string|max:50',
        ], [
            'kode_barang.unique' =>
                'Kode barang sudah digunakan. Silakan gunakan kode yang berbeda.',

            'nama_barang.unique' =>
                'Nama barang sudah tersedia. Silakan gunakan nama barang yang berbeda.',
        ]);

        Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'satuan' => $request->satuan,
            'stok' => 0,
        ]);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Data barang berhasil ditambahkan.');
    }


    public function show($id)
    {
        $barang = Barang::with('category')->findOrFail($id);

        return view('Barang.show', compact('barang'));
    }


    public function edit($id)
    {
        $barang = Barang::findOrFail($id);

        $kategori = Category::whereIn(
            'nama_kategori',
            ['Proyek', 'Maintenance']
        )->orderBy('nama_kategori')->get();

        return view('Barang.edit', compact(
            'barang',
            'kategori'
        ));
    }


    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'kode_barang' =>
                'required|string|max:50|unique:barang,kode_barang,' . $barang->id,

            'nama_barang' =>
                'required|string|max:255|unique:barang,nama_barang,' . $barang->id,

            'kategori_id' =>
                'required|exists:category,id',

            'satuan' =>
                'required|string|max:50',
        ], [
            'kode_barang.unique' =>
                'Kode barang sudah digunakan oleh barang lain.',

            'nama_barang.unique' =>
                'Nama barang sudah digunakan oleh barang lain.',
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
}