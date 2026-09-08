@extends('Layouts.app')

@section('title', 'Dashboard Teknisi')
@section('page-title', 'Dashboard Teknisi')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold">Selamat datang, {{ auth()->user()->name }} 👋</h3>
    <p class="text-muted mb-0">
        Kelola stok peralatan dan catat aktivitas inventaris.
    </p>
</div>

<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="card stat-card">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="text-muted">Total Barang</small>
                    <h3 class="fw-bold mt-2">{{ $totalBarang }}</h3>
                </div>
                <i class="bi bi-box fs-1 text-primary"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="text-muted">Total Stok</small>
                    <h3 class="fw-bold mt-2">{{ $totalStok }}</h3>
                </div>
                <i class="bi bi-boxes fs-1 text-success"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="text-muted">Stok Masuk Saya</small>
                    <h3 class="fw-bold mt-2">{{ $stokMasukSaya }}</h3>
                </div>
                <i class="bi bi-box-arrow-in-down fs-1 text-info"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="text-muted">Stok Keluar Saya</small>
                    <h3 class="fw-bold mt-2">{{ $stokKeluarSaya }}</h3>
                </div>
                <i class="bi bi-box-arrow-up fs-1 text-warning"></i>
            </div>
        </div>
    </div>

</div>


<div class="card p-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">
            Aktivitas Stok Masuk Saya
        </h5>

        <a href="{{ route('stok-masuk.index') }}"
           class="btn btn-primary btn-sm">
            Lihat Stok Masuk
        </a>
    </div>

    <div class="table-responsive">

        <table class="table align-middle">

            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>

                @forelse($aktivitasSaya as $aktivitas)

                <tr>
                    <td>
                        {{ $aktivitas->barang->nama_barang ?? '-' }}
                    </td>

                    <td>
                        <span class="badge bg-success">
                            +{{ $aktivitas->jumlah }}
                        </span>
                    </td>

                    <td>
                        {{ $aktivitas->keterangan ?? '-' }}
                    </td>

                    <td>
                        {{ $aktivitas->created_at->format('d/m/Y H:i') }}
                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        Belum ada aktivitas stok.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection