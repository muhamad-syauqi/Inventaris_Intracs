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

    <form method="POST"
          action="{{ route('stok-masuk.store-barang') }}">

        @csrf

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

            <div class="col-md-6 mb-3">
                <label class="form-label">Kategori</label>

                <select name="kategori_id"
                        class="form-select"
                        required>

                    <option value="">
                        Pilih Kategori
                    </option>

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}">
                            {{ $category->nama_kategori }}
                        </option>

                    @endforeach

                </select>
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