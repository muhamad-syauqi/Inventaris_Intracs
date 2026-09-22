<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class PublicDashboardController extends Controller
{
    public function index(Request $request)
{
    $totalBarang = Barang::count();
    $totalStok = Barang::sum('stok');
    $barangTersedia = Barang::where('stok', '>', 0)->count();
    $barangHabis = Barang::where('stok', 0)->count();

    $query = Barang::with('category');

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('nama_barang', 'like', '%' . $request->search . '%')
              ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
        });
    }

    $barang = $query
        ->orderBy('nama_barang')
        ->paginate(10)
        ->withQueryString();

    return view('public.dashboard', compact(
        'totalBarang',
        'totalStok',
        'barangTersedia',
        'barangHabis',
        'barang'
    ));
}
}