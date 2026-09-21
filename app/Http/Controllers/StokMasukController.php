<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokMasukController extends Controller
{
    public function tambahStokPage()
    {
        $barang = Barang::orderBy('nama_barang')->get();

        $teknisi = \App\Models\User::where('role', 'teknisi')
            ->orderBy('name')
            ->get();

        return view('stok_masuk.tambah-stok', compact('barang', 'teknisi'));
    }


    public function tambahStok(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'nomor_do' => 'required|string|max:100',
            'tanggal_request' => 'required|date',
            'nama_request' => 'required|string|max:150',
            'pengambil' => 'required|string|max:150',
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
                'pengambil' => $request->pengambil,
                'keterangan' => $request->keterangan,
            ]);


            $barang->increment(
                'stok',
                $request->jumlah
            );
        });


        return redirect()
            ->route('stok-masuk.tambah-stok')
            ->with(
                'success',
                'Stok berhasil ditambahkan.'
            );
    }
}