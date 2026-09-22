@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Keluarkan Stok</h3>
            <p class="text-muted mb-0">
                Masukkan lokasi penggunaan barang
            </p>
        </div>

        <a href="{{ route('stok-keluar.index') }}"
           class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form action="{{ route('stok-keluar.store') }}"
                  method="POST">

                @csrf

                {{-- Barang --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Barang
                    </label>

                    <input type="hidden"
                           name="barang_id"
                           value="{{ $barang->id }}">

                    <input type="text"
                           class="form-control"
                           value="{{ $barang->nama_barang }}"
                           readonly>
                </div>

                {{-- Kode Barang --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Kode Barang
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $barang->kode_barang }}"
                           readonly>
                </div>

                {{-- Stok --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Stok Tersedia
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $barang->stok }} {{ $barang->satuan }}"
                           readonly>
                </div>

                {{-- Jumlah --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Jumlah Keluar <span class="text-danger">*</span>
                    </label>

                    <input type="number"
                           name="jumlah"
                           class="form-control"
                           min="1"
                           max="{{ $barang->stok }}"
                           required>

                    @error('jumlah')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- Gerbang Tol --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Gerbang Tol <span class="text-danger">*</span>
                    </label>

                    <select name="gerbang_tol"
                            id="gerbang_tol"
                            class="form-select"
                            required>

                        <option value="">
                            -- Pilih Gerbang Tol --
                        </option>

                        <option value="KALITAMA 1">KALITAMA 1</option>
                        <option value="KALITAMA 2">KALITAMA 2</option>
                        <option value="KALITAMA 3">KALITAMA 3</option>

                        <option value="SADANG">SADANG</option>
                        <option value="JATILUHUR">JATILUHUR</option>
                        <option value="CIKAMUNING">CIKAMUNING</option>
                        <option value="PADALARANG">PADALARANG</option>
                        <option value="BAROS 1">BAROS 1</option>
                        <option value="BAROS 2">BAROS 2</option>
                        <option value="PASTEUR">PASTEUR</option>
                        <option value="PASIR KOJA">PASIR KOJA</option>
                        <option value="KOPO">KOPO</option>
                        <option value="MUHAMAD TOHA">MUHAMAD TOHA</option>
                        <option value="BUAH BATU">BUAH BATU</option>
                        <option value="CILEUNYI">CILEUNYI</option>

                        <option value="SOREANG">SOREANG</option>
                        <option value="KUTAWARINGIN TIMUR">
                            KUTAWARINGIN TIMUR
                        </option>
                        <option value="KUTAWARINGIN BARAT">
                            KUTAWARINGIN BARAT
                        </option>
                        <option value="MARGA ASIH TIMUR">
                            MARGA ASIH TIMUR
                        </option>
                        <option value="MARGA ASIH BARAT">
                            MARGA ASIH BARAT
                        </option>

                    </select>

                    @error('gerbang_tol')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- Nomor Gardu --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Nomor Gardu <span class="text-danger">*</span>
                    </label>

                    <select name="nomor_gardu"
                            id="nomor_gardu"
                            class="form-select"
                            required
                            disabled>

                        <option value="">
                            -- Pilih Gerbang Tol terlebih dahulu --
                        </option>

                    </select>

                    @error('nomor_gardu')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- Keterangan --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Keterangan
                    </label>

                    <textarea name="keterangan"
                              class="form-control"
                              rows="3"
                              placeholder="Keterangan penggunaan barang"></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('stok-keluar.index') }}"
                       class="btn btn-secondary">
                        Batal
                    </a>

                    <button type="submit"
                            class="btn btn-primary">
                        <i class="bi bi-box-arrow-up"></i>
                        Keluarkan Stok
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const gerbangSelect = document.getElementById('gerbang_tol');
    const garduSelect = document.getElementById('nomor_gardu');

    const dataGardu = {

        // KALITAMA
        "KALITAMA 1": [
            "07", "09", "11", "13", "15", "17", "19", 
            "21", "23", "25", "27", "29", "31", "33", 
            "35", "37", "39", "41", "43"
        ],

        "KALITAMA 2": [
            "08", "10", "12", "14", "16", "18", "20", 
            "22", "24", "26", "28", "30", "32", "34", 
            "36", "38", "40", "42", "44"
        ],

        "KALITAMA 3": [
            "01", "03", "05", "02", "04", "06"
        ],

        // GERBANG LAIN
        "SADANG": [
            "01", "03", "05", "02", "04", "06", "08", "10"
        ],

        "JATILUHUR": [
            "05", "07", "02", "04", "06", "08", "03"
        ],

        "CIKAMUNING": [
            "2", "4"
        ],

        "PADALARANG": [
            "01", "03", "05", "07", "06", "08", "10",
            "12", "14", "09", "11", "16", "18"
        ],

        "BAROS 1": [
            "01", "03", "02", "04", "06", "12", "11", "16", "18"
        ],

        "BAROS 2": [
            "05", "07", "09", "08", "10", "14"
        ],

        "PASTEUR": [
            "13", "15", "17", "19", "21", "02", "04", "06", "08",
            "10", "12", "14", "16", "09", "11", "18", "20", "22"
        ],

        "PASIR KOJA": [
            "03", "05", "07", "09", "02", "04",
            "06", "08", "10", "12", "14"
        ],

        "KOPO": [
            "05", "07", "09", "02", "04", "06", "08"
        ],

        "MUHAMAD TOHA": [
            "01", "03", "05", "02", "04",
            "06", "08", "07", "10", "12"
        ],

        "BUAH BATU": [
            "07", "09", "11", "13", "02",
            "04", "06", "08", "10", "12"
        ],

        "CILEUNYI": [
            "02", "04", "12", "14", "16", "18",
            "22", "24", "26", "28", "30", "32"
        ],

        "SOREANG": [
            "01", "03", "05", "02", "04", "06", "08",
            "07"
        ],

        "KUTAWARINGIN TIMUR": [
            "01", "03", "02", "04"
        ],

        "KUTAWARINGIN BARAT": [
            "01", "02", "03", "04"
        ],

        "MARGA ASIH TIMUR": [
            "01", "02", "03", "04", "06"
        ],

        "MARGA ASIH BARAT": [
            "01", "02", "03", "04"
        ]
    };


    gerbangSelect.addEventListener('change', function () {

        const gerbang = this.value;

        garduSelect.innerHTML = '';

        if (!gerbang || !dataGardu[gerbang]) {

            garduSelect.disabled = true;

            garduSelect.innerHTML = `
                <option value="">
                    -- Pilih Gerbang Tol terlebih dahulu --
                </option>
            `;

            return;
        }

        garduSelect.disabled = false;

        garduSelect.innerHTML = `
            <option value="">
                -- Pilih Nomor Gardu --
            </option>
        `;

        dataGardu[gerbang].forEach(function (gardu) {

            const option = document.createElement('option');

            option.value = gardu;
            option.textContent = 'Gardu ' + gardu;

            garduSelect.appendChild(option);

        });

    });

});
</script>

@endsection