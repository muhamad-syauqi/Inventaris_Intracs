@extends('layouts.app')

@section('title', 'Barang')
@section('page-title', 'Barang')

@section('content')

<style>
    .page-header {
        margin-bottom: 24px;
    }

    .page-header h2 {
        font-weight: 700;
        margin-bottom: 5px;
    }

    .page-header p {
        margin: 0;
        color: #6c757d;
    }

    .stat-card {
        border: none;
        border-radius: 14px;
        padding: 20px;
        background: #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        height: 100%;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-bottom: 12px;
    }

    .stat-title {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .stat-value {
        font-size: 26px;
        font-weight: 700;
        margin: 0;
    }

    .barang-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }

    .filter-box {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 18px;
    }

    .table thead th {
        background: #f8f9fa;
        color: #495057;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        border-bottom: 1px solid #dee2e6;
    }

    .table tbody td {
        padding: 14px 12px;
        border-bottom: 1px solid #f0f0f0;
    }

    .table tbody tr:hover {
        background: #f8f9fa;
    }

    .kode-barang {
        font-weight: 600;
        color: #495057;
    }

    .nama-barang {
        font-weight: 600;
    }

    .badge-stock {
        min-width: 65px;
        padding: 7px 10px;
        border-radius: 20px;
        font-size: 12px;
    }

    .action-btn {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }

    .empty-state {
        padding: 50px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 45px;
        margin-bottom: 12px;
        display: block;
    }
</style>

{{-- HEADER --}}
<div class="page-header">
    <h2>Daftar Barang</h2>
    <p>
        Kelola dan pantau seluruh barang yang tersedia dalam inventaris.
    </p>
</div>

{{-- STATISTIK --}}
<div class="row g-3 mb-4">

    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                <i class="bi bi-box-seam"></i>
            </div>

            <div class="stat-title">
                Total Jenis Barang
            </div>

            <p class="stat-value">
                {{ $barang->total() }}
            </p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon bg-success bg-opacity-10 text-success">
                <i class="bi bi-boxes"></i>
            </div>

            <div class="stat-title">
                Total Stok
            </div>

            <p class="stat-value">
                {{ $barang->sum('stok') }}
            </p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                <i class="bi bi-tags"></i>
            </div>

            <div class="stat-title">
                Kategori
            </div>

            <p class="stat-value">
                {{ $categories->count() }}
            </p>
        </div>
    </div>

</div>

{{-- DATA BARANG --}}
<div class="card barang-card">

    <div class="card-body p-4">

        {{-- FILTER --}}
        <div class="filter-box mb-4">

            <form method="GET">

                <div class="row g-3 align-items-end">

                    <div class="col-md-7">

                        <label class="form-label fw-semibold">
                            Cari Barang
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-search"></i>
                            </span>

                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="Nama barang atau kode barang..."
                                value="{{ request('search') }}"
                            >

                        </div>

                    </div>

                    <div class="col-md-3">

                        <label class="form-label fw-semibold">
                            Kategori
                        </label>

                        <select
                            name="kategori_id"
                            class="form-select"
                        >

                            <option value="">
                                Semua Kategori
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ request('kategori_id') == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->nama_kategori }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-2">

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            <i class="bi bi-search me-1"></i>
                            Cari
                        </button>

                    </div>

                </div>

                @if(request('search') || request('kategori_id'))

                    <div class="mt-3">

                        <a
                            href="{{ route('barang.index') }}"
                            class="btn btn-sm btn-outline-secondary"
                        >
                            <i class="bi bi-arrow-counterclockwise me-1"></i>
                            Reset Filter
                        </a>

                    </div>

                @endif

            </form>

        </div>

        {{-- JUDUL TABEL --}}
        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>
                <h5 class="mb-1 fw-bold">
                    Data Barang
                </h5>

                <small class="text-muted">
                    Menampilkan {{ $barang->count() }} data pada halaman ini
                </small>
            </div>

        </div>

        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead>

                    <tr>
                        <th width="60">No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Stok</th>
                        <th width="110">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($barang as $item)

                    <tr>

                        {{-- NO --}}
                        <td class="text-muted">
                            {{ $barang->firstItem() + $loop->index }}
                        </td>

                        {{-- KODE --}}
                        <td>
                            <span class="kode-barang">
                                {{ $item->kode_barang }}
                            </span>
                        </td>

                        {{-- NAMA --}}
                        <td>
                            <span class="nama-barang">
                                {{ $item->nama_barang }}
                            </span>
                        </td>

                        {{-- KATEGORI --}}
                        <td>

                            @if($item->category)

                                <span class="badge bg-light text-dark border">
                                    <i class="bi bi-tag me-1"></i>
                                    {{ $item->category->nama_kategori }}
                                </span>

                            @else

                                <span class="text-muted">
                                    -
                                </span>

                            @endif

                        </td>

                        {{-- SATUAN --}}
                        <td>
                            {{ $item->satuan }}
                        </td>

                        {{-- STOK --}}
                        <td>

                            @if($item->stok == 0)

                                <span class="badge bg-danger badge-stock">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Habis
                                </span>

                            @elseif($item->stok <= 10)

                                <span class="badge bg-warning text-dark badge-stock">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    {{ $item->stok }}
                                </span>

                            @else

                                <span class="badge bg-success badge-stock">
                                    <i class="bi bi-check-circle me-1"></i>
                                    {{ $item->stok }}
                                </span>

                            @endif

                        </td>

                        {{-- AKSI --}}
                        <td>

                            <div class="d-flex gap-1">

                                {{-- DETAIL --}}
                                <a
                                    href="{{ route('barang.show', $item) }}"
                                    class="btn btn-sm btn-info text-white action-btn"
                                    title="Lihat Detail"
                                >
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- EDIT --}}
                                <a
                                    href="{{ route('barang.edit', $item) }}"
                                    class="btn btn-sm btn-primary action-btn"
                                    title="Edit Barang"
                                >
                                    <i class="bi bi-pencil"></i>
                                </a>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7">

                            <div class="empty-state text-center">

                                <i class="bi bi-box-seam"></i>

                                <h6 class="fw-bold">
                                    Belum Ada Data Barang
                                </h6>

                                <p class="mb-0">
                                    Data barang belum tersedia atau
                                    tidak ditemukan berdasarkan filter.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        @if($barang->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $barang->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection