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

        {{-- PILIH BARANG --}}
        <div class="mb-4">

            <label class="form-label">
                Pilih Barang
                <span class="text-danger">*</span>
            </label>

            <div class="searchable-select" id="barangSearchBox">

                <input
                    type="text"
                    id="barangSearchInput"
                    class="form-control"
                    placeholder="Cari kode atau nama barang..."
                    autocomplete="off"
                    value="{{ old('barang_id') ? optional($barang->firstWhere('id', old('barang_id')))->kode_barang . ' - ' . optional($barang->firstWhere('id', old('barang_id')))->nama_barang : '' }}"
                >

                <input
                    type="hidden"
                    name="barang_id"
                    id="barangId"
                    value="{{ old('barang_id') }}"
                    required
                >

                <div class="searchable-options" id="barangOptions">

                    @foreach($barang as $item)

                        <div
                            class="searchable-option"
                            data-id="{{ $item->id }}"
                            data-search="{{ strtolower($item->kode_barang . ' ' . $item->nama_barang) }}"
                            data-display="{{ $item->kode_barang }} - {{ $item->nama_barang }}"
                        >

                            <div class="fw-semibold">
                                {{ $item->nama_barang }}
                            </div>

                            <small class="text-muted">
                                {{ $item->kode_barang }}
                                · Stok saat ini: {{ $item->stok }}
                            </small>

                        </div>

                    @endforeach

                    <div
                        id="barangTidakDitemukan"
                        class="text-muted text-center py-3 d-none"
                    >
                        Barang tidak ditemukan
                    </div>

                </div>

            </div>

            @error('barang_id')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="row g-3">

            <div class="col-12 col-md-6">
                <label class="form-label">
                    Nomor DO
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="nomor_do"
                    class="form-control"
                    value="{{ old('nomor_do') }}"
                    placeholder="Masukkan nomor DO"
                    required
                >
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label">
                    Tanggal Request
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="date"
                    name="tanggal_request"
                    class="form-control"
                    value="{{ old('tanggal_request') }}"
                    required
                >
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label">
                    PIC Request
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="nama_request"
                    class="form-control"
                    value="{{ old('nama_request') }}"
                    placeholder="Masukkan nama PIC request"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="pengambil" class="form-label">
                    Pengambil
                </label>

                <select
                    name="pengambil"
                    id="pengambil"
                    class="form-select"
                    required
                >
                    <option value="">-- Pilih Teknisi --</option>

                    @foreach($teknisi as $item)
                        <option
                            value="{{ $item->name }}"
                            {{ old('pengambil') == $item->name ? 'selected' : '' }}
                        >
                            {{ $item->name }}
                        </option>
                    @endforeach

                </select>

                @error('pengambil')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label">
                    Keterangan
                </label>

                <input
                    type="text"
                    name="keterangan"
                    class="form-control"
                    value="{{ old('keterangan') }}"
                    placeholder="Keterangan tambahan"
                >
            </div>

        </div>

        <div class="mt-3 mb-4">
            <label class="form-label">
                Jumlah Stok yang Ditambahkan
                <span class="text-danger">*</span>
            </label>

            <input
                type="number"
                name="jumlah"
                class="form-control"
                min="1"
                value="{{ old('jumlah') }}"
                required
            >
        </div>

        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i>
            Tanggal dan waktu stok masuk dicatat
            secara otomatis oleh sistem.
        </div>

        <button
            type="submit"
            class="btn btn-success"
        >
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Stok
        </button>

    </form>

</div>


{{-- CSS SEARCHABLE DROPDOWN --}}
<style>

.searchable-select {
    position: relative;
}

.searchable-options {
    position: absolute;
    top: calc(100% + 4px);
    left: 0;
    right: 0;
    background: #fff;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    max-height: 280px;
    overflow-y: auto;
    z-index: 9999;
    display: none;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
}

.searchable-option {
    padding: 11px 14px;
    cursor: pointer;
    border-bottom: 1px solid #f1f1f1;
    transition: background 0.15s;
}

.searchable-option:last-child {
    border-bottom: none;
}

.searchable-option:hover {
    background: #f4f7ff;
}

.searchable-option.selected {
    background: #e8f0ff;
}

</style>


{{-- JAVASCRIPT SEARCHABLE DROPDOWN --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('barangSearchInput');
    const hiddenInput = document.getElementById('barangId');
    const optionsBox = document.getElementById('barangOptions');
    const options = document.querySelectorAll('.searchable-option');
    const notFound = document.getElementById('barangTidakDitemukan');
    const searchBox = document.getElementById('barangSearchBox');

    // Buka dropdown ketika input diklik
    input.addEventListener('focus', function () {
        optionsBox.style.display = 'block';
        filterBarang();
    });

    // Pencarian barang
    input.addEventListener('input', function () {

        // Kalau user mengetik ulang,
        // pilihan barang sebelumnya dibatalkan
        hiddenInput.value = '';

        options.forEach(option => {
            option.classList.remove('selected');
        });

        filterBarang();
    });

    function filterBarang() {

        const keyword = input.value
            .toLowerCase()
            .trim();

        let ditemukan = 0;

        options.forEach(option => {

            const searchText = option.dataset.search;

            if (searchText.includes(keyword)) {

                option.style.display = 'block';
                ditemukan++;

            } else {

                option.style.display = 'none';

            }

        });

        if (ditemukan === 0) {
            notFound.classList.remove('d-none');
        } else {
            notFound.classList.add('d-none');
        }

        optionsBox.style.display = 'block';
    }


    // Ketika barang dipilih
    options.forEach(option => {

        option.addEventListener('click', function () {

            const id = this.dataset.id;
            const display = this.dataset.display;

            // Simpan ID barang untuk dikirim ke controller
            hiddenInput.value = id;

            // Tampilkan barang yang dipilih
            input.value = display;

            // Tutup dropdown
            optionsBox.style.display = 'none';

            // Tandai pilihan
            options.forEach(item => {
                item.classList.remove('selected');
            });

            this.classList.add('selected');

        });

    });


    // Klik di luar dropdown
    document.addEventListener('click', function (event) {

        if (!searchBox.contains(event.target)) {
            optionsBox.style.display = 'none';
        }

    });

});

</script>

@endsection