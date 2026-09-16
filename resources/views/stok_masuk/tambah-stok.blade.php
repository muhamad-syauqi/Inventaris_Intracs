@extends('layouts.app')

@section('title', 'Tambah Stok')
@section('page-title', 'Tambah Stok')

@section('content')

<div class="mb-4">
    <h2>Tambah Stok</h2>

    <p class="text-muted">
        Tambahkan stok pada barang yang sudah terdaftar.
    </p>
</div>


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


@if($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan:</strong>

        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="card p-4 shadow-sm">

    <form method="POST"
          action="{{ route('stok-masuk.tambah') }}">

        @csrf


        <div class="mb-4">

            <label class="form-label">
                Pilih Barang
            </label>

            <select name="barang_id"
                    class="form-select"
                    required>

                <option value="">
                    Pilih barang
                </option>

                @foreach($barang as $item)

                    <option value="{{ $item->id }}"
                        {{ old('barang_id') == $item->id ? 'selected' : '' }}>

                        {{ $item->kode_barang }}
                        -
                        {{ $item->nama_barang }}
                        | Stok saat ini: {{ $item->stok }}

                    </option>

                @endforeach

            </select>

        </div>


        <div class="row g-3">


            <div class="col-12 col-md-6">

                <label class="form-label">
                    Nomor DO
                    <span class="text-danger">*</span>
                </label>

                <input type="text"
                       name="nomor_do"
                       class="form-control"
                       value="{{ old('nomor_do') }}"
                       placeholder="Masukkan nomor DO"
                       required>

            </div>


            <div class="col-12 col-md-6">

                <label class="form-label">
                    Tanggal Request
                    <span class="text-danger">*</span>
                </label>

                <input type="date"
                       name="tanggal_request"
                       class="form-control"
                       value="{{ old('tanggal_request') }}"
                       required>

            </div>


            <div class="col-12 col-md-6">

                <label class="form-label">
                    PIC Request
                    <span class="text-danger">*</span>
                </label>

                <input type="text"
                       name="nama_request"
                       class="form-control"
                       value="{{ old('nama_request') }}"
                       placeholder="Masukkan nama PIC request"
                       required>

            </div>


            <div class="col-12 col-md-6">

                <label class="form-label">
                    Keterangan
                </label>

                <input type="text"
                       name="keterangan"
                       class="form-control"
                       value="{{ old('keterangan') }}"
                       placeholder="Keterangan tambahan">

            </div>

        </div>


        <div class="mt-3 mb-4">

            <label class="form-label">
                Jumlah Stok yang Ditambahkan
            </label>

            <input type="number"
                   name="jumlah"
                   class="form-control"
                   min="1"
                   value="{{ old('jumlah') }}"
                   required>

        </div>


        <div class="alert alert-info">

            <i class="bi bi-info-circle"></i>

            Tanggal dan waktu stok masuk dicatat
            secara otomatis oleh sistem.

        </div>


        <button type="submit"
                class="btn btn-success">

            <i class="bi bi-plus-circle me-1"></i>

            Tambah Stok

        </button>

    </form>

</div>

@endsection