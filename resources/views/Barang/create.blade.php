@extends('layouts.app')

@section('title', 'Tambah Barang')
@section('page-title', 'Tambah Barang')

@section('content')

<div class="card p-4">

    <h4 class="mb-4">Input Data Barang</h4>

    <form method="POST" action="{{ route('barang.store') }}">

        @csrf

        <div class="row">

            <div class="col-md-6 mb-3">

                <label>Kode Barang</label>

                <input type="text"
                       name="kode_barang"
                       class="form-control"
                       value="{{ old('kode_barang') }}">

                @error('kode_barang')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label>Nama Barang</label>

                <input type="text"
                       name="nama_barang"
                       class="form-control"
                       value="{{ old('nama_barang') }}">

            </div>

            <div class="col-md-6 mb-3">

                <label>Kategori</label>

                <select name="kategori_id" class="form-select">

                    <option value="">Pilih Kategori</option>

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}">
                            {{ $category->nama_kategori }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-3 mb-3">

                <label>Satuan</label>

                <input type="text"
                       name="satuan"
                       class="form-control"
                       placeholder="Pcs">

            </div>

            <div class="col-md-3 mb-3">

                <label>Stok</label>

                <input type="number"
                       name="stok"
                       class="form-control"
                       min="0"
                       value="0">

            </div>

        </div>

        <div class="mb-3">

            <label>Keterangan</label>

            <textarea class="form-control"
                      name="keterangan"
                      rows="3"></textarea>

        </div>

        <a href="{{ route('barang.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

        <button class="btn btn-primary">
            <i class="bi bi-save"></i>
            Simpan
        </button>

    </form>

</div>

@endsection