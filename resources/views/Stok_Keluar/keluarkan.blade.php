@extends('layouts.app')

@section('title', 'Keluarkan Stok')
@section('page-title', 'Keluarkan Stok')

@section('content')

<div class="mb-4">
    <h2>Keluarkan Stok</h2>
    <p class="text-muted">
        Masukkan jumlah stok yang ingin dikeluarkan.
    </p>
</div>

<div class="card p-4">

    <div class="mb-4">

        <h5>
            {{ $barang->nama_barang }}
        </h5>

        <p class="text-muted mb-1">
            Kode Barang: {{ $barang->kode_barang }}
        </p>

        <p class="text-muted mb-1">
            Satuan: {{ $barang->satuan }}
        </p>

        <div class="alert alert-info mt-3">

            <strong>Stok tersedia:</strong>
            {{ $barang->stok }} {{ $barang->satuan }}

        </div>

    </div>


    <form method="POST"
          action="{{ route('stok-keluar.store') }}">

        @csrf

        <input type="hidden"
               name="barang_id"
               value="{{ $barang->id }}">


        <div class="mb-4">

            <label class="form-label">
                Jumlah yang Dikeluarkan
            </label>

            <input type="number"
                   name="jumlah"
                   class="form-control"
                   min="1"
                   max="{{ $barang->stok }}"
                   required>

            <small class="text-muted">
                Maksimal {{ $barang->stok }}
                {{ $barang->satuan }}
            </small>

        </div>


        <div class="mb-4">

            <label class="form-label">
                Keterangan
            </label>

            <textarea name="keterangan"
                      class="form-control"
                      rows="3"
                      placeholder="Contoh: Digunakan untuk kebutuhan kantor"></textarea>

        </div>


        <div class="alert alert-secondary">

            <i class="bi bi-clock"></i>

            Tanggal dan waktu transaksi akan
            dicatat otomatis oleh sistem.

        </div>


        <a href="{{ route('stok-keluar.index') }}"
           class="btn btn-secondary">

            Kembali

        </a>

        <button type="submit"
                class="btn btn-danger">

            <i class="bi bi-box-arrow-up"></i>
            Keluarkan Stok

        </button>

    </form>

</div>

@endsection