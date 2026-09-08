@extends('layouts.app')

@section('title', 'Dashboard Teknisi')
@section('page-title', 'Dashboard Teknisi')

@section('content')

<div class="mb-4">
    <h2>Dashboard Teknisi</h2>

    <p class="text-muted">
        Selamat datang, {{ auth()->user()->name }}.
        Kelola transaksi inventaris melalui dashboard ini.
    </p>
</div>


{{-- STATISTIK --}}
<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="text-muted">
                        Total Barang
                    </small>

                    <h3 class="fw-bold mt-2">
                        {{ $totalBarang }}
                    </h3>
                </div>

                <i class="bi bi-box fs-1 text-primary"></i>
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="text-muted">
                        Total Stok
                    </small>

                    <h3 class="fw-bold mt-2">
                        {{ $totalStok }}
                    </h3>
                </div>

                <i class="bi bi-box-seam fs-1 text-success"></i>
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="text-muted">
                        Stok Masuk Saya
                    </small>

                    <h3 class="fw-bold mt-2">
                        {{ $stokMasukSaya }}
                    </h3>
                </div>

                <i class="bi bi-box-arrow-in-down fs-1 text-success"></i>
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="text-muted">
                        Stok Keluar Saya
                    </small>

                    <h3 class="fw-bold mt-2">
                        {{ $stokKeluarSaya }}
                    </h3>
                </div>

                <i class="bi bi-box-arrow-up fs-1 text-danger"></i>
            </div>
        </div>
    </div>

</div>


{{-- AKTIVITAS --}}
<div class="card border-0 shadow-sm">

    <div class="card-body">

        <h5 class="fw-bold mb-3">
            Aktivitas Stok Masuk Terbaru
        </h5>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($aktivitasSaya as $item)

                        <tr>

                            <td>
                                {{ $item->barang->nama_barang ?? '-' }}
                            </td>

                            <td>
                                <span class="badge bg-success">
                                    +{{ $item->jumlah }}
                                </span>
                            </td>

                            <td>
                                {{ $item->keterangan ?? '-' }}
                            </td>

                            <td>
                                {{ $item->created_at->format('d-m-Y H:i') }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4"
                                class="text-center text-muted py-4">

                                Belum ada aktivitas.

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection