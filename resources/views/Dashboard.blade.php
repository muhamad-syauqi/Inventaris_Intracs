@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<style>
    .stat-card {
        border: none;
        border-radius: 16px;
        transition: 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-3px);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .icon-blue {
        background: #e8f1ff;
        color: #0d6efd;
    }

    .icon-green {
        background: #e8f8ef;
        color: #198754;
    }

    .icon-orange {
        background: #fff3df;
        color: #fd7e14;
    }

    .icon-red {
        background: #fdeaea;
        color: #dc3545;
    }

    .dashboard-card {
        border: none;
        border-radius: 16px;
    }

    .table th {
        font-weight: 600;
        color: #6c757d;
    }
</style>


{{-- ========================= --}}
{{-- KARTU STATISTIK --}}
{{-- ========================= --}}

<div class="row g-4 mb-4">

    {{-- TOTAL BARANG --}}
    <div class="col-xl-3 col-md-6">

        <div class="card stat-card shadow-sm h-100 p-3">

            <div class="d-flex align-items-center justify-content-between">

                <div>
                    <p class="text-muted mb-2">
                        Total Barang
                    </p>

                    <h2 class="fw-bold mb-0">
                        {{ $totalBarang }}
                    </h2>
                </div>

                <div class="stat-icon icon-blue">
                    <i class="bi bi-box-seam"></i>
                </div>

            </div>

        </div>

    </div>


    {{-- TOTAL STOK --}}
    <div class="col-xl-3 col-md-6">

        <div class="card stat-card shadow-sm h-100 p-3">

            <div class="d-flex align-items-center justify-content-between">

                <div>
                    <p class="text-muted mb-2">
                        Total Stok
                    </p>

                    <h2 class="fw-bold mb-0">
                        {{ $totalStok }}
                    </h2>
                </div>

                <div class="stat-icon icon-green">
                    <i class="bi bi-stack"></i>
                </div>

            </div>

        </div>

    </div>


    {{-- STOK MASUK --}}
    <div class="col-xl-3 col-md-6">

        <div class="card stat-card shadow-sm h-100 p-3">

            <div class="d-flex align-items-center justify-content-between">

                <div>
                    <p class="text-muted mb-2">
                        Stok Masuk
                    </p>

                    <h2 class="fw-bold mb-0">
                        {{ $totalStokMasuk }}
                    </h2>
                </div>

                <div class="stat-icon icon-orange">
                    <i class="bi bi-box-arrow-in-down"></i>
                </div>

            </div>

        </div>

    </div>


    {{-- STOK KELUAR --}}
    <div class="col-xl-3 col-md-6">

        <div class="card stat-card shadow-sm h-100 p-3">

            <div class="d-flex align-items-center justify-content-between">

                <div>
                    <p class="text-muted mb-2">
                        Stok Keluar
                    </p>

                    <h2 class="fw-bold mb-0">
                        {{ $totalStokKeluar }}
                    </h2>
                </div>

                <div class="stat-icon icon-red">
                    <i class="bi bi-box-arrow-up"></i>
                </div>

            </div>

        </div>

    </div>

</div>


{{-- ========================= --}}
{{-- STOK MASUK TERBARU --}}
{{-- ========================= --}}

<div class="card dashboard-card shadow-sm">

    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h5 class="fw-bold mb-1">
                    Stok Masuk Terbaru
                </h5>

                <p class="text-muted mb-0">
                    Daftar transaksi stok masuk terbaru
                </p>
            </div>

            <a href="{{ route('laporan.stok-masuk') }}"
               class="btn btn-success">

                <i class="bi bi-file-earmark-text me-1"></i>
                Lihat Semua

            </a>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>

                        <th>No</th>

                        <th>Kode Barang</th>

                        <th>Nama Barang</th>

                        <th>Jumlah</th>

                        <th>Keterangan</th>

                        <th>Tanggal</th>

                    </tr>
                </thead>

                <tbody>

                    @forelse($stokTerbaru as $item)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $item->barang->kode_barang ?? '-' }}
                            </td>

                            <td class="fw-semibold">
                                {{ $item->barang->nama_barang ?? '-' }}
                            </td>

                            <td>

                                <span class="badge bg-success-subtle text-success">

                                    +{{ $item->jumlah }}

                                </span>

                            </td>

                            <td>
                                {{ $item->keterangan ?? '-' }}
                            </td>

                            <td>
                                {{ $item->created_at->format('d/m/Y H:i') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center text-muted py-4">

                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>

                                Belum ada data stok masuk.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection