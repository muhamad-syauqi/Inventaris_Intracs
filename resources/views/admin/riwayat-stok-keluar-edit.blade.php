@extends('layouts.app')

@section('title', 'Edit Stok Keluar')
@section('page-title', 'Edit Stok Keluar')

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <h4 class="fw-bold mb-4">Edit Stok Keluar</h4>

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
                action="{{ route('admin.riwayat-stok-keluar.update', $stokKeluar->id) }}"
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
                                {{ $stokKeluar->barang_id == $item->id ? 'selected' : '' }}
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
                        value="{{ old('jumlah', $stokKeluar->jumlah) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Gerbang Tol
                    </label>

                    <input
                        type="text"
                        name="gerbang_tol"
                        class="form-control"
                        value="{{ old('gerbang_tol', $stokKeluar->gerbang_tol) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Nomor Gardu
                    </label>

                    <input
                        type="text"
                        name="nomor_gardu"
                        class="form-control"
                        value="{{ old('nomor_gardu', $stokKeluar->nomor_gardu) }}"
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
                    >{{ old('keterangan', $stokKeluar->keterangan) }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Simpan Perubahan
                    </button>

                    <a
                        href="{{ route('admin.riwayat-stok-keluar') }}"
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