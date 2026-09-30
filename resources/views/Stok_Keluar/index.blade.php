@extends('layouts.app')

@section('title', 'Stok Keluar')

@section('content')

<style>
    .page-title {
        font-size: 26px;
        font-weight: 700;
        color: #172b4d;
    }

    .page-subtitle {
        color: #6c757d;
        font-size: 14px;
    }

    .filter-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 20px;
    }

    .barang-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 18px;
        height: 100%;
        transition: .2s ease;
    }

    .barang-card:hover {
        border-color: #0d6efd;
        box-shadow: 0 5px 18px rgba(0, 0, 0, .07);
        transform: translateY(-2px);
    }

    .barang-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #eef4ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .barang-name {
        font-size: 17px;
        font-weight: 600;
        color: #172b4d;
        margin-bottom: 4px;
    }

    .barang-code {
        color: #6c757d;
        font-size: 13px;
    }

    .stock-badge {
        font-size: 12px;
        padding: 6px 9px;
        border-radius: 7px;
    }

    .tag {
        display: inline-block;
        font-size: 11px;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 6px;
        margin-right: 4px;
    }

    .tag-new {
        background: #e8f7ee;
        color: #198754;
    }

    .tag-repair {
        background: #fff3cd;
        color: #997404;
    }

    .tag-proyek {
        background: #e8f0ff;
        color: #0d6efd;
    }

    .tag-maintenance {
        background: #f1e8ff;
        color: #6f42c1;
    }

    .btn-keluarkan {
        width: 100%;
        border-radius: 8px;
        font-weight: 600;
    }

    .empty-box {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 50px 20px;
        text-align: center;
        color: #6c757d;
    }
</style>

<div class="container-fluid px-0">

    {{-- HEADER --}}
    <div class="mb-4">
        <h1 class="page-title mb-1">Stok Keluar</h1>
        <div class="page-subtitle">
            Pilih barang yang ingin dikeluarkan dari stok.
        </div>
    </div>

    {{-- FILTER --}}
    <div class="filter-card">

        <form action="{{ route('stok-keluar.index') }}" method="GET">

            <div class="row g-2">

                {{-- SEARCH --}}
                <div class="col-lg-5">
                    <label class="form-label small fw-semibold">
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
                            placeholder="Kode atau nama barang..."
                            value="{{ request('search') }}"
                        >
                    </div>
                </div>

                {{-- JENIS --}}
                <div class="col-lg-3">
                    <label class="form-label small fw-semibold">
                        Jenis Barang
                    </label>

                    <select name="jenis_barang" class="form-select">
                        <option value="">Semua Jenis</option>

                        <option value="New"
                            {{ request('jenis_barang') == 'New' ? 'selected' : '' }}>
                            New
                        </option>

                        <option value="Repair"
                            {{ request('jenis_barang') == 'Repair' ? 'selected' : '' }}>
                            Repair
                        </option>
                    </select>
                </div>

                {{-- KATEGORI --}}
                <div class="col-lg-3">
                    <label class="form-label small fw-semibold">
                        Kategori
                    </label>

                    <select name="kategori_id" class="form-select">
                        <option value="">Semua Kategori</option>

                        @foreach($kategori as $item)
                            <option
                                value="{{ $item->id }}"
                                {{ request('kategori_id') == $item->id ? 'selected' : '' }}
                            >
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- BUTTON --}}
                <div class="col-lg-1 d-flex align-items-end">
                    <button type="submit"
                            class="btn btn-primary w-100">
                        <i class="bi bi-search"></i>
                    </button>
                </div>

            </div>

            @if(request()->filled('search') ||
                request()->filled('jenis_barang') ||
                request()->filled('kategori_id'))

                <div class="mt-2">
                    <a href="{{ route('stok-keluar.index') }}"
                       class="small text-decoration-none">
                        <i class="bi bi-x-circle"></i>
                        Reset Filter
                    </a>
                </div>

            @endif

        </form>

    </div>


    {{-- JUMLAH HASIL --}}
    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <span class="fw-semibold">
                Daftar Barang
            </span>

            <span class="text-muted small ms-2">
                {{ $barang->total() }} barang
            </span>
        </div>

    </div>


    {{-- BARANG --}}
    @if($barang->count())

        <div class="row g-3">

            @foreach($barang as $item)

                <div class="col-xl-3 col-lg-4 col-md-6">

                    <div class="barang-card">

                        {{-- ICON + STOK --}}
                        <div class="d-flex justify-content-between align-items-start mb-3">

                            <div class="barang-icon">
                                <i class="bi bi-box-seam"></i>
                            </div>

                            @if($item->stok > 0)

                                <span class="badge bg-success stock-badge">
                                    Stok {{ $item->stok }}
                                </span>

                            @else

                                <span class="badge bg-secondary stock-badge">
                                    Stok 0
                                </span>

                            @endif

                        </div>


                        {{-- NAMA --}}
                        <div class="barang-name">
                            {{ $item->nama_barang }}
                        </div>

                        <div class="barang-code mb-3">
                            {{ $item->kode_barang }}
                            · {{ $item->satuan }}
                        </div>


                        {{-- PENANDA --}}
                        <div class="mb-3">

                            {{-- JENIS --}}
                            @if($item->jenis_barang === 'New')

                                <span class="tag tag-new">
                                    <i class="bi bi-stars"></i>
                                    New
                                </span>

                            @elseif($item->jenis_barang === 'Repair')

                                <span class="tag tag-repair">
                                    <i class="bi bi-tools"></i>
                                    Repair
                                </span>

                            @endif


                            {{-- KATEGORI --}}
                            @if($item->category)

                                @if($item->category->nama_kategori === 'Proyek')

                                    <span class="tag tag-proyek">
                                        <i class="bi bi-diagram-3"></i>
                                        Proyek
                                    </span>

                                @elseif($item->category->nama_kategori === 'Maintenance')

                                    <span class="tag tag-maintenance">
                                        <i class="bi bi-wrench"></i>
                                        Maintenance
                                    </span>

                                @endif

                            @endif

                        </div>


                        {{-- BUTTON --}}
                        @if($item->stok > 0)

                            <a href="{{ route('stok-keluar.keluarkan', $item->id) }}"
                               class="btn btn-primary btn-sm btn-keluarkan">
                                <i class="bi bi-box-arrow-up me-1"></i>
                                Keluarkan Stok
                            </a>

                        @else

                            <button class="btn btn-light btn-sm btn-keluarkan"
                                    disabled>
                                <i class="bi bi-dash-circle me-1"></i>
                                Stok Habis
                            </button>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>


        {{-- PAGINATION --}}
        <div class="mt-4">
            {{ $barang->links() }}
        </div>


    @else

        <div class="empty-box">

            <i class="bi bi-box-seam fs-1 d-block mb-3"></i>

            <h5 class="fw-semibold">
                Barang tidak ditemukan
            </h5>

            <p class="mb-0">
                Coba ubah kata pencarian atau filter yang digunakan.
            </p>

        </div>

    @endif

</div>

@endsection