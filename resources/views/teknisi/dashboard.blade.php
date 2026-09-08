@extends('layouts.app')

@section('title', 'Dashboard Teknisi')
@section('page-title', 'Dashboard Teknisi')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold">Dashboard Teknisi</h2>

    <p class="text-muted">
        Selamat datang, {{ auth()->user()->name }}.
        Kelola transaksi inventaris melalui dashboard ini.
    </p>
</div>


{{-- STATISTIK --}}
<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Total Barang</p>
                        <h2 class="fw-bold mb-0">
                            {{ $totalBarang }}
                        </h2>
                    </div>

                    <i class="bi bi-box-seam fs-1 text-primary"></i>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Total Stok</p>
                        <h2 class="fw-bold mb-0">
                            {{ $totalStok }}
                        </h2>
                    </div>

                    <i class="bi bi-stack fs-1 text-success"></i>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Stok Masuk Saya</p>
                        <h2 class="fw-bold mb-0">
                            {{ $stokMasukSaya }}
                        </h2>
                    </div>

                    <i class="bi bi-box-arrow-in-down fs-1 text-success"></i>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Stok Keluar Saya</p>
                        <h2 class="fw-bold mb-0">
                            {{ $stokKeluarSaya }}
                        </h2>
                    </div>

                    <i class="bi bi-box-arrow-up fs-1 text-danger"></i>
                </div>
            </div>
        </div>
    </div>

</div>


{{-- AKTIVITAS --}}
<div class="card border-0 shadow-sm">

    <div class="card-body">

        <div class="mb-3">
            <h5 class="fw-bold mb-1">
                Aktivitas Transaksi Terbaru
            </h5>

            <p class="text-muted mb-0">
                Aktivitas transaksi yang dilakukan oleh Anda.
            </p>
        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>
                        <th>No</th>
                        <th>Jenis</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Tanggal & Jam</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($aktivitasSaya as $item)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>


                            <td>

                                @if($item->jenis === 'Stok Masuk')

                                    <span class="badge bg-success">
                                        <i class="bi bi-arrow-down"></i>
                                        Stok Masuk
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        <i class="bi bi-arrow-up"></i>
                                        Stok Keluar
                                    </span>

                                @endif

                            </td>


                            <td>
                                <strong>
                                    {{ $item->barang->nama_barang ?? '-' }}
                                </strong>
                            </td>


                            <td>

                                @if($item->jenis === 'Stok Masuk')
                                    <span class="text-success fw-bold">
                                        +{{ $item->jumlah }}
                                    </span>
                                @else
                                    <span class="text-danger fw-bold">
                                        -{{ $item->jumlah }}
                                    </span>
                                @endif

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

                            <td colspan="6"
                                class="text-center text-muted py-5">

                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>

                                Belum ada aktivitas transaksi.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection