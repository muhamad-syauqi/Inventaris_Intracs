@extends('layouts.app')

@section('title', 'Tambah Barang')
@section('page-title', 'Tambah Barang')

@section('content')

<div class="card p-4">

    <h4 class="mb-4">
        Tambah Data Barang
    </h4>


    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form method="POST"
          action="{{ route('barang.store') }}">

        @csrf


        <div class="mb-3">

            <label class="form-label">
                Kode Barang
            </label>

            <input type="text"
                   name="kode_barang"
                   class="form-control"
                   value="{{ old('kode_barang') }}"
                   required>

        </div>


        <div class="mb-3">

            <label class="form-label">
                Nama Barang
            </label>

            <input type="text"
                   name="nama_barang"
                   class="form-control"
                   value="{{ old('nama_barang') }}"
                   required>

        </div>


        <div class="mb-3">

            <label class="form-label">
                Kategori
            </label>

            <select name="kategori_id"
                    class="form-select"
                    required>

                <option value="">
                    Pilih kategori
                </option>

                @foreach($kategori as $item)

                    <option value="{{ $item->id }}">

                        {{ $item->nama_kategori }}

                    </option>

                @endforeach

            </select>

        </div>


        <div class="mb-4">

            <label class="form-label">
                Satuan
            </label>

            <input type="text"
                   name="satuan"
                   class="form-control"
                   placeholder="Contoh: pcs, unit, meter"
                   required>

        </div>


        <a href="{{ route('barang.index') }}"
           class="btn btn-secondary">

            Kembali

        </a>


        <button type="submit"
                class="btn btn-primary">

            Simpan Barang

        </button>

    </form>

</div>

@endsection