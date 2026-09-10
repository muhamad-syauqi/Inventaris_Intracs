@extends('layouts.app')

@section('title', 'Input Data Barang')
@section('page-title', 'Input Data Barang')

@section('content')

<div class="mb-4">
    <h2>Input Data Barang</h2>
    <p class="text-muted">
        Masukkan data barang baru.
    </p>
</div>

<div class="card p-4">

    @if ($errors->any())
    <div class="alert alert-danger">
        <div class="d-flex align-items-start">
            <i class="bi bi-exclamation-circle-fill me-2"></i>

            <div>
                <strong>Data barang sudah tersedia</strong>

                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <div class="mt-2">
                    Silakan menambah data barang dengan kode atau nama barang yang berbeda.
                </div>
            </div>
        </div>
    </div>
@endif

    <form method="POST"
          action="{{ route('stok-masuk.store-barang') }}">

        @csrf

        <div class="row g-3">

    {{-- NOMOR DO --}}
    <div class="col-md-6">
        <label class="form-label">
            Nomor DO <span class="text-danger">*</span>
        </label>

        <input type="text"
               name="nomor_do"
               class="form-control"
               value="{{ old('nomor_do') }}"
               placeholder="Masukkan nomor DO"
               required>
    </div>


    {{-- TANGGAL REQUEST --}}
    <div class="col-md-6">
        <label class="form-label">
            Tanggal Request <span class="text-danger">*</span>
        </label>

        <input type="date"
               name="tanggal_request"
               class="form-control"
               value="{{ old('tanggal_request') }}"
               required>
    </div>


    {{-- NAMA REQUEST --}}
    <div class="col-md-6">
        <label class="form-label">
            PIC Request <span class="text-danger">*</span>
        </label>

        <input type="text"
               name="nama_request"
               class="form-control"
               value="{{ old('nama_request') }}"
               placeholder="Masukkan nama orang yang mengajukan"
               required>
    </div>


    {{-- KATEGORI --}}
    <div class="col-md-6">
        <label class="form-label">
            Kategori Barang <span class="text-danger">*</span>
        </label>

        <select name="kategori_id"
                class="form-select"
                required>

            <option value="">
                -- Pilih Kategori --
            </option>

            @foreach($categories as $category)

                <option value="{{ $category->id }}"
                    {{ old('kategori_id') == $category->id ? 'selected' : '' }}>

                    {{ $category->nama_kategori }}

                </option>

            @endforeach

        </select>
    </div>

</div>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label">Kode Barang</label>

                <input type="text"
                       name="kode_barang"
                       class="form-control"
                       required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Barang</label>

                <input type="text"
                       name="nama_barang"
                       class="form-control"
                       required>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Satuan</label>

                <input type="text"
                       name="satuan"
                       class="form-control"
                       placeholder="Pcs"
                       required>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Stok Awal</label>

                <input type="number"
                       name="stok"
                       class="form-control"
                       min="0"
                       required>
            </div>

        </div>

        <div class="mt-3">

            <a href="{{ route('stok-masuk.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

            <button type="submit"
                    class="btn btn-primary">
                Simpan Barang
            </button>

        </div>

    </form>

</div>

@endsection