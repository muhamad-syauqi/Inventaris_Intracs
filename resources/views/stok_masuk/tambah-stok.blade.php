@extends('layouts.app')

@section('title', 'Tambah Stok')
@section('page-title', 'Tambah Stok')

@section('content')

<div class="mb-4">
    <h2>Tambah Stok</h2>
    <p class="text-muted">
        Tambahkan stok pada barang yang sudah tersedia.
    </p>
</div>

<div class="card p-4">

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

                    <option value="{{ $item->id }}">
                        {{ $item->kode_barang }}
                        -
                        {{ $item->nama_barang }}
                        | Stok saat ini: {{ $item->stok }}
                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="form-label">
                Jumlah Stok yang Ditambahkan
            </label>

            <input type="number"
                   name="jumlah"
                   class="form-control"
                   min="1"
                   required>

        </div>

        <div class="mb-4">

            <label class="form-label">
                Keterangan
            </label>

            <textarea name="keterangan"
                      class="form-control"
                      rows="3"
                      placeholder="Contoh: Pembelian barang"></textarea>

        </div>

        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i>
            Tanggal dan waktu stok masuk akan dicatat
            secara otomatis oleh sistem.
        </div>

        <a href="{{ route('stok-masuk.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

        <button type="submit"
                class="btn btn-success">
            Tambah Stok
        </button>

    </form>

</div>

@endsection