@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="mb-4">
    <h2>Dashboard</h2>
    <p class="text-muted">
        Ringkasan kondisi inventaris peralatan.
    </p>
</div>

<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="card stat-card">
            <p class="text-muted mb-1">Jenis Barang</p>
            <h2>{{ $totalBarang }}</h2>
            <i class="bi bi-box fs-3 text-primary"></i>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card">
            <p class="text-muted mb-1">Total Stok</p>
            <h2>{{ $totalStok }}</h2>
            <i class="bi bi-boxes fs-3 text-success"></i>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card">
            <p class="text-muted mb-1">Stok Masuk</p>
            <h2>{{ $totalStokMasuk }}</h2>
            <i class="bi bi-arrow-down-circle fs-3 text-success"></i>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card">
            <p class="text-muted mb-1">Stok Keluar</p>
            <h2>{{ $totalStokKeluar }}</h2>
            <i class="bi bi-arrow-up-circle fs-3 text-danger"></i>
        </div>
    </div>

</div>

<div class="card p-4">

    <h5 class="mb-3">Stok Masuk Terbaru</h5>

    <div class="table-responsive">

        <table class="table align-middle">

            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>

            @forelse($stokTerbaru as $data)

                <tr>
                    <td>{{ $data->barang->nama_barang }}</td>
                    <td>{{ $data->jumlah }} {{ $data->barang->satuan }}</td>
                    <td>{{ $data->keterangan ?? '-' }}</td>
                    <td>{{ $data->created_at->format('d/m/Y H:i') }}</td>
                </tr>

            @empty

                <tr>
                    <td colspan="4" class="text-center">
                        Belum ada transaksi.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection