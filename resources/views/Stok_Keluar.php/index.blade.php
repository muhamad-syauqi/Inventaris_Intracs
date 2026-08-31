@extends('layouts.app')

@section('title', 'Stok Keluar')
@section('page-title', 'Stok Keluar')

@section('content')

<div class="mb-4">

    <h2>Stok Keluar</h2>

    <p class="text-muted">
        Pilih barang yang akan dikeluarkan dari persediaan.
    </p>

</div>

<div class="row g-4">

    {{-- DAFTAR BARANG --}}

    <div class="col-md-7">

        <div class="card p-4">

            <h5 class="mb-4">
                Daftar Barang
            </h5>

            <div class="row g-3">

                @forelse($barang as $item)

                    <div class="col-md-6">

                        <div class="border rounded p-3 h-100">

                            <div class="d-flex justify-content-between">

                                <div>

                                    <small class="text-muted">
                                        {{ $item->kode_barang }}
                                    </small>

                                    <h6 class="mt-1">
                                        {{ $item->nama_barang }}
                                    </h6>

                                </div>

                                <i class="bi bi-box-seam fs-3 text-primary"></i>

                            </div>

                            <div class="mt-3">

                                <span class="badge bg-success">
                                    Stok {{ $item->stok }}
                                    {{ $item->satuan }}
                                </span>

                            </div>

                            <button type="button"
                                    class="btn btn-primary btn-sm w-100 mt-3"
                                    onclick="pilihBarang(
                                        {{ $item->id }},
                                        '{{ $item->nama_barang }}',
                                        {{ $item->stok }},
                                        '{{ $item->satuan }}'
                                    )">

                                Keluarkan Barang

                            </button>

                        </div>

                    </div>

                @empty

                    <div class="text-center py-5">

                        <i class="bi bi-box fs-1 text-muted"></i>

                        <p class="text-muted mt-2">
                            Tidak ada barang yang tersedia.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- FORM KELUARKAN STOK --}}

    <div class="col-md-5">

        <div class="card p-4">

            <h5 class="mb-4">
                Keluarkan Stok
            </h5>

            <form method="POST"
                  action="{{ route('stok-keluar.store') }}">

                @csrf

                <input type="hidden"
                       name="barang_id"
                       id="barang_id">

                <div class="mb-3">

                    <label>Barang</label>

                    <input type="text"
                           id="nama_barang"
                           class="form-control"
                           readonly
                           placeholder="Pilih barang terlebih dahulu">

                </div>

                <div class="mb-3">

                    <label>Stok Tersedia</label>

                    <div class="input-group">

                        <input type="text"
                               id="stok_tersedia"
                               class="form-control"
                               readonly>

                        <span class="input-group-text"
                              id="satuan">
                        </span>

                    </div>

                </div>

                <div class="mb-3">

                    <label>Jumlah yang Keluar</label>

                    <input type="number"
                           name="jumlah"
                           id="jumlah"
                           class="form-control"
                           min="1"
                           required>

                </div>

                <div class="mb-3">

                    <label>Keterangan</label>

                    <textarea name="keterangan"
                              class="form-control"
                              rows="3"
                              placeholder="Contoh: Digunakan untuk perbaikan"></textarea>

                </div>

                <div class="alert alert-info">

                    <i class="bi bi-clock"></i>

                    Tanggal dan waktu akan dicatat
                    otomatis oleh sistem.

                </div>

                <button class="btn btn-danger w-100">

                    <i class="bi bi-box-arrow-up"></i>

                    Keluarkan Stok

                </button>

            </form>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

function pilihBarang(id, nama, stok, satuan)
{
    document.getElementById('barang_id').value = id;

    document.getElementById('nama_barang').value = nama;

    document.getElementById('stok_tersedia').value = stok;

    document.getElementById('satuan').innerText = satuan;

    document.getElementById('jumlah').max = stok;

    document.getElementById('jumlah').value = '';
}

</script>

@endpush