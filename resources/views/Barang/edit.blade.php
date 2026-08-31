@extends('layouts.app')

@section('title', 'Edit Barang')
@section('page-title', 'Edit Barang')

@section('content')

<div class="mb-4">
    <h2>Edit Barang</h2>
    <p class="text-muted">
        Ubah informasi barang.
    </p>
</div>

<div class="card p-4">

    <form method="POST"
          action="{{ route('barang.update', $barang) }}">

        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Kode Barang
                </label>

                <input type="text"
                       name="kode_barang"
                       class="form-control"
                       value="{{ old('kode_barang', $barang->kode_barang) }}"
                       required>

                @error('kode_barang')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Nama Barang
                </label>

                <input type="text"
                       name="nama_barang"
                       class="form-control"
                       value="{{ old('nama_barang', $barang->nama_barang) }}"
                       required>

                @error('nama_barang')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Kategori
                </label>

                <select name="kategori_id"
                        class="form-select"
                        required>

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}"
                            {{ old('kategori_id', $barang->kategori_id) == $category->id ? 'selected' : '' }}>

                            {{ $category->nama_kategori }}

                        </option>

                    @endforeach

                </select>

                @error('kategori_id')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            <div class="col-md-3 mb-3">

                <label class="form-label">
                    Satuan
                </label>

                <input type="text"
                       name="satuan"
                       class="form-control"
                       value="{{ old('satuan', $barang->satuan) }}"
                       required>

            </div>

            <div class="col-md-3 mb-3">

                <label class="form-label">
                    Stok
                </label>

                <input type="number"
                       name="stok"
                       class="form-control"
                       min="0"
                       value="{{ old('stok', $barang->stok) }}"
                       required>

            </div>

        </div>

        <div class="mt-3">

            <a href="{{ route('barang.index') }}"
               class="btn btn-secondary">
                Batal
            </a>

            <button type="submit"
                    class="btn btn-primary">
                <i class="bi bi-save"></i>
                Simpan Perubahan
            </button>

        </div>

    </form>

</div>

@endsection