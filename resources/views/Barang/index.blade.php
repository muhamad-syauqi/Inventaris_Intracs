@extends('layouts.app')

@section('title', 'Data Barang')
@section('page-title', 'Data Barang')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-1">Data Barang</h2>

        <p class="text-muted mb-0">
            Kelola seluruh data barang yang tersedia dalam inventaris.
        </p>
    </div>

    <a href="{{ route('barang.create') }}"
       class="btn btn-primary px-4">

        <i class="bi bi-plus-circle me-2"></i>
        Tambah Barang

    </a>

</div>


{{-- FILTER --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-body p-4">

        <div class="d-flex align-items-center mb-3">

            <div class="bg-primary bg-opacity-10 rounded p-2 me-3">
                <i class="bi bi-funnel text-primary"></i>
            </div>

            <div>
                <h6 class="fw-bold mb-0">
                    Filter Data Barang
                </h6>

                <small class="text-muted">
                    Cari berdasarkan kode, nama, atau kategori.
                </small>
            </div>

        </div>


        <form method="GET">

            <div class="row g-3">

                {{-- SEARCH --}}
                <div class="col-12 col-md-6">

                    <label class="form-label fw-semibold">
                        Pencarian
                    </label>

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="bi bi-search text-muted"></i>
                        </span>

                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Cari kode atau nama barang..."
                               value="{{ request('search') }}">

                    </div>

                </div>


                {{-- KATEGORI --}}
                <div class="col-12 col-md-4">

                    <label class="form-label fw-semibold">
                        Kategori
                    </label>

                    <select name="kategori_id"
                            class="form-select">

                        <option value="">
                            Semua Kategori
                        </option>

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}"
                                {{ request('kategori_id') == $category->id ? 'selected' : '' }}>

                                {{ $category->nama_kategori }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- BUTTON --}}
                <div class="col-12 col-md-2 d-flex align-items-end">

                    <button type="submit"
                            class="btn btn-primary w-100">

                        <i class="bi bi-search me-1"></i>
                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


{{-- TABLE --}}
<div class="card border-0 shadow-sm">

    <div class="card-body p-0">

        {{-- TABLE HEADER --}}
        <div class="p-4 border-bottom">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="fw-bold mb-1">
                        Daftar Barang
                    </h5>

                    <small class="text-muted">
                        Total data:
                        {{ $barang->total() }}
                        barang
                    </small>

                </div>

                @if(request('search') || request('kategori_id'))

                    <a href="{{ route('barang.index') }}"
                       class="btn btn-sm btn-outline-secondary">

                        <i class="bi bi-x-circle me-1"></i>
                        Reset Filter

                    </a>

                @endif

            </div>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th class="ps-4" style="width: 60px;">
                            No
                        </th>

                        <th>
                            Kode Barang
                        </th>

                        <th>
                            Nama Barang
                        </th>

                        <th>
                            Kategori
                        </th>

                        <th>
                            Satuan
                        </th>

                        <th class="text-center">
                            Stok
                        </th>

                        <th class="text-center pe-4"
                            style="width: 150px;">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($barang as $item)

                    <tr>

                        {{-- NO --}}
                        <td class="ps-4 text-muted">

                            {{ $barang->firstItem() + $loop->index }}

                        </td>


                        {{-- KODE --}}
                        <td>

                            <span class="fw-semibold">
                                {{ $item->kode_barang }}
                            </span>

                        </td>


                        {{-- NAMA --}}
                        <td>

                            <div class="d-flex align-items-center">

                                <div class="bg-primary bg-opacity-10
                                            rounded-circle
                                            d-flex align-items-center
                                            justify-content-center
                                            me-3"
                                     style="width:40px;height:40px;">

                                    <i class="bi bi-box text-primary"></i>

                                </div>

                                <div>

                                    <div class="fw-semibold">
                                        {{ $item->nama_barang }}
                                    </div>

                                </div>

                            </div>

                        </td>


                        {{-- KATEGORI --}}
                        <td>

                            @if($item->category)

                                <span class="badge bg-light
                                             text-dark border">

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

                            <span class="text-muted">
                                {{ $item->satuan }}
                            </span>

                        </td>


                        {{-- STOK --}}
                        <td class="text-center">

                            @if($item->stok == 0)

                                <span class="badge bg-danger px-3 py-2">

                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    Habis

                                </span>

                            @elseif($item->stok <= 10)

                                <span class="badge bg-warning
                                             text-dark px-3 py-2">

                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    {{ $item->stok }}

                                </span>

                            @else

                                <span class="badge bg-success px-3 py-2">

                                    <i class="bi bi-check-circle me-1"></i>
                                    {{ $item->stok }}

                                </span>

                            @endif

                        </td>


                        {{-- AKSI --}}
                        <td class="text-center pe-4">

                            <div class="btn-group"
                                 role="group">

                                {{-- DETAIL --}}
                                <a href="{{ route('barang.show', $item->id) }}"
                                   class="btn btn-sm btn-outline-info"
                                   title="Lihat Detail">

                                    <i class="bi bi-eye"></i>

                                </a>


                                {{-- EDIT --}}
                                <a href="{{ route('barang.edit', $item->id) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   title="Edit Barang">

                                    <i class="bi bi-pencil"></i>

                                </a>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="text-center py-5">

                            <div class="mb-3">

                                <i class="bi bi-box-seam
                                          text-muted"
                                   style="font-size: 45px;">
                                </i>

                            </div>

                            <h6 class="fw-bold">
                                Belum Ada Data Barang
                            </h6>

                            <p class="text-muted mb-3">
                                Belum ada barang yang sesuai
                                dengan pencarian.
                            </p>

                            @if(request('search') || request('kategori_id'))

                                <a href="{{ route('barang.index') }}"
                                   class="btn btn-sm btn-outline-primary">

                                    Reset Pencarian

                                </a>

                            @else

                                <a href="{{ route('barang.create') }}"
                                   class="btn btn-sm btn-primary">

                                    <i class="bi bi-plus-circle me-1"></i>
                                    Tambah Barang

                                </a>

                            @endif

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($barang->hasPages())

            <div class="p-4 border-top">

                {{ $barang->links() }}

            </div>

        @endif

    </div>

</div>

@endsection