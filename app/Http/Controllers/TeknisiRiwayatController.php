<?php

namespace App\Http\Controllers;

use App\Models\StokKeluar;

class TeknisiRiwayatController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $riwayat = StokKeluar::with('barang')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('teknisi.riwayat', compact('riwayat'));
    }
}