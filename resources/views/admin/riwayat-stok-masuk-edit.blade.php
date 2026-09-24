@extends('layouts.app')

@section('title', 'Edit Stok Masuk')
@section('page-title', 'Edit Stok Masuk')

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <h4 class="fw-bold mb-4">Edit Stok Masuk</h4>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('admin.riwayat-stok-masuk.update', $stokMasuk->id) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Barang
                    </label>

                    <select name="barang_id" class="form-select" required>
                        @foreach($barang as $item)
                            <option
                                value="{{ $item->id }}"
                                {{ $stokMasuk->barang_id == $item->id ? 'selected' : '' }}
                            >
                                {{ $item->kode_barang }} -
                                {{ $item->nama_barang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Jumlah
                    </label>

                    <input
                        type="number"
                        name="jumlah"
                        class="form-control"
                        min="1"
                        value="{{ old('jumlah', $stokMasuk->jumlah) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Nomor DO
                    </label>

                    <input
                        type="text"
                        name="nomor_do"
                        class="form-control"
                        value="{{ old('nomor_do', $stokMasuk->nomor_do) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Tanggal Request
                    </label>

                    <input
                        type="date"
                        name="tanggal_request"
                        class="form-control"
                        value="{{ old('tanggal_request', $stokMasuk->tanggal_request) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Nama Request
                    </label>

                    <input
                        type="text"
                        name="nama_request"
                        class="form-control"
                        value="{{ old('nama_request', $stokMasuk->nama_request) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Pengambil
                    </label>

                    <input
                        type="text"
                        name="pengambil"
                        class="form-control"
                        value="{{ old('pengambil', $stokMasuk->pengambil) }}"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Keterangan
                    </label>

                    <textarea
                        name="keterangan"
                        class="form-control"
                        rows="3"
                    >{{ old('keterangan', $stokMasuk->keterangan) }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Simpan Perubahan
                    </button>

                    <a
                        href="{{ route('admin.riwayat-stok-masuk') }}"
                        class="btn btn-light border"
                    >
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection