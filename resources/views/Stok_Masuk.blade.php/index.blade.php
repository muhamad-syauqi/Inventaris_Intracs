@extends('layouts.app')

@section('title', 'Stok Masuk')
@section('page-title', 'Stok Masuk')

@section('content')

<div class="mb-4">

    <h2>Stok Masuk</h2>

    <p class="text-muted">
        Tambahkan barang baru atau tambah stok barang yang sudah tersedia.
    </p>

</div>

<div class="row g-4">

    {{-- INPUT DATA BARANG --}}

    <div class="col-md-6">

        <div class="card p-4">

            <h5 class="mb-4">
                <i class="bi bi-plus-square text-primary"></i>
                Input Data Barang
            </h5>

            <form method="POST"
                  action="{{ route('stok-masuk.store-barang') }}">

                @csrf

                <div class="mb-3">

                    <label>Kode Barang</label>

                    <input type="text"
                           name="kode_barang"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label>Nama Barang</label>

                    <input type="text"
                           name="nama_barang"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label>Kategori</label>

                    <select name="kategori_id"
                            class="form-select"
                            required>

                        <option value="">Pilih Kategori</option>

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}">
                                {{ $category->nama_kategori }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Jumlah Stok</label>

                        <input type="number"
                               name="stok"
                               class="form-control"
                               min="0"
                               required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Satuan</label>

                        <input type="text"
                               name="satuan"
                               class="form-control"
                               placeholder="Pcs"
                               required>

                    </div>

                </div>

                <button class="btn btn-primary w-100">
                    <i class="bi bi-save"></i>
                    Simpan Barang
                </button>

            </form>

        </div>

    </div>


    {{-- TAMBAH STOK --}}

    <div class="col-md-6">

        <div class="card p-4">

            <h5 class="mb-4">

                <i class="bi bi-plus-circle text-success"></i>

                Tambah Stok

            </h5>

            <form method="POST"
                  action="{{ route('stok-masuk.tambah') }}">

                @csrf

                <div class="mb-3">

                    <label>Pilih Barang</label>

                    <select name="barang_id"
                            class="form-select"
                            required>

                        <option value="">
                            Pilih barang
                        </option>

                        @foreach($barang as $item)

                            <option value="{{ $item->id }}">

                                {{ $item->kode_barang }}
                                -
                                {{ $item->nama_barang }}

                                (Stok: {{ $item->stok }})

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label>Jumlah Stok Ditambahkan</label>

                    <input type="number"
                           name="jumlah"
                           class="form-control"
                           min="1"
                           required>

                </div>

                <div class="mb-3">

                    <label>Keterangan</label>

                    <textarea name="keterangan"
                              class="form-control"
                              rows="4"
                              placeholder="Contoh: Pembelian barang"></textarea>

                </div>

                <div class="alert alert-info">

                    <i class="bi bi-info-circle"></i>

                    Tanggal dan waktu transaksi akan dicatat
                    otomatis oleh sistem.

                </div>

                <button class="btn btn-success w-100">

                    <i class="bi bi-plus-lg"></i>

                    Tambah Stok

                </button>

            </form>

        </div>

    </div>

</div>

@endsection