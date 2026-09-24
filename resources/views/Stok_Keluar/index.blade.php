@extends('layouts.app')

@section('title', 'Stok Keluar')
@section('page-title', 'Stok Keluar')

@section('content')

<div class="mb-4">
    <h2>Daftar Barang</h2>
    <p class="text-muted">
        Pilih barang yang ingin dikeluarkan stoknya.
    </p>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">

        <form action="{{ route('stok-keluar.index') }}" method="GET">

            <div class="row g-2">

                <div class="col-md-10">
                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="bi bi-search"></i>
                        </span>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Cari kode barang atau nama barang..."
                        >

                    </div>
                </div>

                <div class="col-md-2">

                    <button
                        type="submit"
                        class="btn btn-primary w-100"
                    >
                        <i class="bi bi-search"></i>
                        Cari
                    </button>

                </div>

            </div>

        </form>

    </div>
</div>

@if(request('search'))
    <div class="mt-2">
        <a
            href="{{ route('stok-keluar.index') }}"
            class="btn btn-sm btn-outline-secondary"
        >
            <i class="bi bi-x-circle"></i>
            Reset Pencarian
        </a>
    </div>
@endif

<div class="row g-4">

    @forelse($barang as $item)

        <div class="col-12 col-md-4">

            <div class="card h-100 p-4">

                <div class="d-flex justify-content-between mb-3">

                    <i class="bi bi-box-seam fs-2 text-primary"></i>

                    <span class="badge bg-success">
                        Stok {{ $item->stok }}
                    </span>

                </div>

                <h5>
                    {{ $item->nama_barang }}
                </h5>

                <p class="text-muted mb-1">
                    Kode: {{ $item->kode_barang }}
                </p>

                <p class="text-muted">
                    Satuan: {{ $item->satuan }}
                </p>

                @if(auth()->user()->role === 'teknisi')
                <a href="{{ route('stok-keluar.keluarkan', $item->id) }}"
                   class="btn btn-danger mt-auto">

                    <i class="bi bi-box-arrow-up"></i>
                    Keluarkan Stok

                </a>

                @endif

            </div>

        </div>

    @empty

        <div class="col-12">

            <div class="alert alert-info">
                Belum ada barang yang tersedia.
            </div>

        </div>

    @endforelse

</div>
   
        {{-- PAGINATION --}}
        <div class="mt-3">
            {{ $stokKeluar->links() }}
        </div>

    </div>

</div>


@endsection