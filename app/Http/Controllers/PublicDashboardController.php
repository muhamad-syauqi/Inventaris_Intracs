<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class PublicDashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();

        $totalStok = Barang::sum('stok');

        $barangTersedia = Barang::where('stok', '>', 0)->count();

        $barangHabis = Barang::where('stok', 0)->count();

        $barang = Barang::with('category')
            ->orderBy('nama_barang')
            ->paginate(10);

        return view('public.dashboard', compact(
            'totalBarang',
            'totalStok',
            'barangTersedia',
            'barangHabis',
            'barang'
        ));
    }
}