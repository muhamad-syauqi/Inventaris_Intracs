@extends('layouts.app')

@section('title', 'Stok Masuk')
@section('page-title', 'Stok Masuk')

@section('content')

<div class="mb-4">
    <h2>Stok Masuk</h2>
    <p class="text-muted">
        Kelola barang baru dan penambahan stok barang.
    </p>
</div>

<div class="row g-4">

    

    {{-- INPUT DATA BARANG --}}
    @if(auth()->user()->role === 'teknisi')

        <div class="col-md-6">

            <div class="card p-4 h-100">

                <div class="mb-3">
                    <i class="bi bi-box-seam fs-1 text-primary"></i>
                </div>

                <h4>Input Data Barang</h4>

                <p class="text-muted">
                    Masukkan data barang baru yang belum tersedia
                    dalam sistem inventaris.
                </p>

                <a href="{{ route('stok-masuk.input-barang') }}"
                class="btn btn-primary mt-auto">
                    Input Data Barang
                </a>

            </div>

        </div>

    @endif


    {{-- TAMBAH STOK --}}
    @if(auth()->user()->role === 'teknisi')

        <div class="col-md-6">

            <div class="card p-4 h-100">

                <div class="mb-3">
                    <i class="bi bi-plus-square fs-1 text-success"></i>
                </div>

                <h4>Tambah Stok</h4>

                <p class="text-muted">
                    Tambahkan jumlah stok pada barang yang
                    sudah tersedia di sistem.
                </p>

                <a href="{{ route('stok-masuk.tambah-stok') }}"
                class="btn btn-success mt-auto">
                    Tambah Stok
                </a>

            </div>

        </div>

    @endif
    {{-- RIWAYAT STOK MASUK --}}
<div class="card mt-4">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="mb-1">Riwayat Stok Masuk</h5>
                <p class="text-muted mb-0">
                    Daftar barang yang telah ditambahkan ke dalam stok.
                </p>
            </div>
        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Diinput Oleh</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($stokMasuk as $item)

                        <tr>

                            <td>
                                {{ $stokMasuk->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <strong>
                                    {{ $item->barang->nama_barang ?? '-' }}
                                </strong>
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
                                <i class="bi bi-person-circle me-1"></i>
                                {{ $item->user->name ?? '-' }}
                            </td>

                            <td>
                                {{ $item->created_at->format('d-m-Y H:i') }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada data stok masuk.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="mt-3">
            {{ $stokMasuk->links() }}
        </div>

    </div>

</div>

@endsection