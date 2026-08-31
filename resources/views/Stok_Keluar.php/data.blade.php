@extends('layouts.app')

@section('title', 'Data Stok Keluar')
@section('page-title', 'Data Stok Keluar')

@section('content')

<div class="d-flex justify-content-between mb-4">

    <div>

        <h2>Data Stok Keluar</h2>

        <p class="text-muted">
            Daftar transaksi barang yang telah dikeluarkan.
        </p>

    </div>

    <a href="{{ route('stok-keluar.index') }}"
       class="btn btn-primary">

        <i class="bi bi-plus"></i>
        Keluarkan Stok

    </a>

</div>

<div class="card p-4">

    <div class="table-responsive">

        <table class="table align-middle">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Tanggal & Waktu</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Keterangan</th>
                    <th>Oleh</th>

                </tr>

            </thead>

            <tbody>

            @forelse($stokKeluar as $data)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $data->created_at->format('d/m/Y H:i') }}
                    </td>

                    <td>
                        {{ $data->barang->kode_barang }}
                    </td>

                    <td>
                        {{ $data->barang->nama_barang }}
                    </td>

                    <td>
                        {{ $data->jumlah }}
                    </td>

                    <td>
                        {{ $data->barang->satuan }}
                    </td>

                    <td>
                        {{ $data->keterangan ?? '-' }}
                    </td>

                    <td>
                        {{ $data->user->name }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8"
                        class="text-center py-4">

                        Belum ada data stok keluar.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    {{ $stokKeluar->links() }}

</div>

@endsection