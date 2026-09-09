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

<div class="row g-4">

    @forelse($barang as $item)

        <div class="col-md-4">

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