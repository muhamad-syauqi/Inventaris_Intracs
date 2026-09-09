@extends('layouts.app')

@section('title', 'Stok Masuk')
@section('page-title', 'Stok Masuk')

@section('content')

<div class="mb-4">
    <h2>Stok Masuk</h2>
    <p class="text-muted">
        Kelola barang baru dan penambahan stok barang.
    </p>
</div>

<div class="row g-4">

    

    {{-- INPUT DATA BARANG --}}
    @if(auth()->user()->role === 'teknisi')

        <div class="col-md-6">

            <div class="card p-4 h-100">

                <div class="mb-3">
                    <i class="bi bi-box-seam fs-1 text-primary"></i>
                </div>

                <h4>Input Data Barang</h4>

                <p class="text-muted">
                    Masukkan data barang baru yang belum tersedia
                    dalam sistem inventaris.
                </p>

                <a href="{{ route('stok-masuk.input-barang') }}"
                class="btn btn-primary mt-auto">
                    Input Data Barang
                </a>

            </div>

        </div>

    @endif


    {{-- TAMBAH STOK --}}
    @if(auth()->user()->role === 'teknisi')

        <div class="col-md-6">

            <div class="card p-4 h-100">

                <div class="mb-3">
                    <i class="bi bi-plus-square fs-1 text-success"></i>
                </div>

                <h4>Tambah Stok</h4>

                <p class="text-muted">
                    Tambahkan jumlah stok pada barang yang
                    sudah tersedia di sistem.
                </p>

                <a href="{{ route('stok-masuk.tambah-stok') }}"
                class="btn btn-success mt-auto">
                    Tambah Stok
                </a>

            </div>

        </div>

    @endif
    

        {{-- PAGINATION --}}
        <div class="mt-3">
            {{ $stokMasuk->links() }}
        </div>

    </div>

</div>

@endsection