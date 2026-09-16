@extends('layouts.app')

@section('title', 'Tambah Stok')
@section('page-title', 'Tambah Stok')

@section('content')

<div class="mb-4">
    <h2>Tambah Stok</h2>
    <p class="text-muted">
        Tambahkan stok pada barang yang sudah tersedia.
    </p>
</div>

<div class="row">

    <div class="col-12 col-md-8">

        <div class="card p-4">

            <div class="mb-4">
                <i class="bi bi-box-arrow-in-down fs-1 text-success"></i>
            </div>

            <h4>Tambah Stok Barang</h4>

            <p class="text-muted mb-4">
                Pilih barang yang sudah terdaftar kemudian masukkan
                jumlah stok yang diterima.
            </p>

            <a href="{{ route('stok-masuk.tambah-stok') }}"
               class="btn btn-success">

                <i class="bi bi-plus-circle me-1"></i>
                Tambah Stok

            </a>

        </div>

    </div>

</div>

@endsection