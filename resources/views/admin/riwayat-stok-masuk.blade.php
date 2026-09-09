@extends('layouts.app')
@section('title', 'Riwayat Stok Masuk')
@section('page-title', 'Riwayat Stok Masuk')

@section('content')

<style>
    .page-header {
        background: linear-gradient(135deg, #0d6efd, #084298);
        color: white;
        border-radius: 18px;
        padding: 25px;
        margin-bottom: 20px;
    }

    .stat-card {
        background: white;
        border-radius: 14px;
        padding: 18px;
        box-shadow: 0 3px 15px rgba(0,0,0,.06);
        height: 100%;
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        background: #d1e7dd;
        color: #198754;
    }

    .filter-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 3px 15px rgba(0,0,0,.06);
        margin-bottom: 20px;
    }

    .table-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 3px 15px rgba(0,0,0,.06);
    }

    .table th {
        white-space: nowrap;
        font-size: 13px;
    }

    .table td {
        vertical-align: middle;
        font-size: 13px;
    }

    .badge-category {
        background: #e7f1ff;
        color: #0d6efd;
    }
</style>


<div class="container-fluid">

    {{-- HEADER --}}
    <div class="page-header">

        <h3 class="fw-bold mb-1">
            <i class="bi bi-box-arrow-in-down me-2"></i>
            Riwayat Stok Masuk
        </h3>

        <p class="mb-0">
            Daftar seluruh transaksi stok masuk
        </p>

    </div>


    {{-- STAT --}}
    <div class="row g-3 mb-4">

        <div class="col-md-6">

            <div class="stat-card">

                <div class="d-flex align-items-center">

                    <div class="stat-icon">
                        <i class="bi bi-receipt"></i>
                    </div>

                    <div class="ms-3">

                        <small class="text-muted">
                            Total Transaksi
                        </small>

                        <h4 class="fw-bold mb-0">
                            {{ $totalTransaksi }}
                        </h4>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-6">

            <div class="stat-card">

                <div class="d-flex align-items-center">

                    <div class="stat-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <div class="ms-3">

                        <small class="text-muted">
                            Total Barang Masuk
                        </small>

                        <h4 class="fw-bold mb-0">
                            {{ number_format($totalJumlah) }}
                        </h4>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- FILTER --}}
    <div class="filter-card">

        <form method="GET"
              action="{{ route('admin.riwayat-stok-masuk') }}">

            <div class="row g-3 align-items-end">

                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Dari Tanggal
                    </label>

                    <input type="date"
                           name="tanggal_mulai"
                           class="form-control"
                           value="{{ request('tanggal_mulai') }}">

                </div>


                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Sampai Tanggal
                    </label>

                    <input type="date"
                           name="tanggal_sampai"
                           class="form-control"
                           value="{{ request('tanggal_sampai') }}">

                </div>


                <div class="col-md-4 d-flex gap-2">

                    <button class="btn btn-primary">
                        <i class="bi bi-search"></i>
                        Filter
                    </button>

                    <a href="{{ route('admin.riwayat-stok-masuk') }}"
                       class="btn btn-secondary">
                        Reset
                    </a>

                </div>

            </div>

        </form>


        <div class="mt-3 pt-3 border-top">

            <span class="text-muted me-2">
                Export:
            </span>

            <a href="{{ route('admin.riwayat-stok-masuk.excel', request()->query()) }}"
               class="btn btn-success btn-sm">
                <i class="bi bi-file-earmark-excel"></i>
                Excel
            </a>

            <a href="{{ route('admin.riwayat-stok-masuk.word', request()->query()) }}"
               class="btn btn-primary btn-sm">
                <i class="bi bi-file-earmark-word"></i>
                Word
            </a>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="table-card">

        <div class="table-responsive">

            <table class="table table-hover">

                <thead class="table-light">

                    <tr>
                        <th>No</th>
                        <th>Tanggal Input</th>
                        <th>Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Nomor DO</th>
                        <th>Tanggal Request</th>
                        <th>Nama Request</th>
                        <th>Keterangan</th>
                        <th>Diinput Oleh</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($stokMasuk as $item)

                    <tr>

                        <td>
                            {{ $stokMasuk->firstItem() + $loop->index }}
                        </td>

                        <td>
                            {{ $item->created_at->format('d-m-Y') }}

                            <br>

                            <small class="text-muted">
                                {{ $item->created_at->format('H:i') }} WIB
                            </small>
                        </td>

                        <td>
                            <strong>
                                {{ $item->barang->nama_barang }}
                            </strong>

                            <br>

                            <small class="text-muted">
                                {{ $item->barang->kode_barang }}
                            </small>
                        </td>

                        <td>
                            <span class="badge badge-category">
                                {{ $item->barang->category->nama_kategori ?? '-' }}
                            </span>
                        </td>

                        <td>
                            <strong>
                                {{ $item->jumlah }}
                            </strong>

                            {{ $item->barang->satuan }}
                        </td>

                        <td>
                            {{ $item->nomor_do ?? '-' }}
                        </td>

                        <td>
                            @if($item->tanggal_request)
                                {{ \Carbon\Carbon::parse($item->tanggal_request)->format('d-m-Y') }}
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            {{ $item->nama_request ?? '-' }}
                        </td>

                        <td>
                            {{ $item->keterangan ?? '-' }}
                        </td>

                        <td>
                            <i class="bi bi-person-circle me-1"></i>
                            {{ $item->user->name ?? '-' }}
                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="10"
                            class="text-center py-5 text-muted">

                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>

                            Tidak ada data stok masuk.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="mt-3">

            {{ $stokMasuk->links() }}

        </div>

    </div>

</div>

@endsection