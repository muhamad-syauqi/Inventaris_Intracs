@extends('layouts.app')

@section('title', 'Laporan')
@section('page-title', 'Laporan')

@section('content')

<div class="mb-4">
    <h2>Laporan</h2>
    <p class="text-muted">
        Pilih jenis laporan yang ingin dilihat.
    </p>
</div>

<div class="row g-4">

    {{-- LAPORAN BARANG --}}
    <div class="col-md-4">

        <div class="card p-4 h-100">

            <div class="mb-3">
                <i class="bi bi-box-seam fs-1 text-primary"></i>
            </div>

            <h4>Laporan Barang</h4>

            <p class="text-muted">
                Menampilkan daftar seluruh barang,
                kode barang, kategori, satuan, dan
                jumlah stok yang tersedia.
            </p>

            <a href="{{ route('laporan.barang') }}"
               class="btn btn-primary mt-auto">

                <i class="bi bi-eye"></i>
                Lihat Laporan

            </a>

        </div>

    </div>


    {{-- LAPORAN STOK MASUK --}}
    <div class="col-md-4">

        <div class="card p-4 h-100">

            <div class="mb-3">
                <i class="bi bi-box-arrow-in-down fs-1 text-success"></i>
            </div>

            <h4>Laporan Stok Masuk</h4>

            <p class="text-muted">
                Menampilkan riwayat barang yang masuk
                beserta jumlah dan waktu transaksi.
            </p>

            <a href="{{ route('laporan.stok-masuk') }}"
               class="btn btn-success mt-auto">

                <i class="bi bi-eye"></i>
                Lihat Laporan

            </a>

        </div>

    </div>


    {{-- LAPORAN STOK KELUAR --}}
    <div class="col-md-4">

        <div class="card p-4 h-100">

            <div class="mb-3">
                <i class="bi bi-box-arrow-up fs-1 text-danger"></i>
            </div>

            <h4>Laporan Stok Keluar</h4>

            <p class="text-muted">
                Menampilkan riwayat barang yang keluar
                beserta jumlah dan waktu transaksi.
            </p>

            <a href="{{ route('laporan.stok-keluar') }}"
               class="btn btn-danger mt-auto">

                <i class="bi bi-eye"></i>
                Lihat Laporan

            </a>

        </div>

    </div>

</div>

@endsection