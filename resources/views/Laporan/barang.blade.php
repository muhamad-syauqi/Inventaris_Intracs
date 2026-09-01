@extends('layouts.app')

@section('title', 'Laporan Barang')
@section('page-title', 'Laporan Barang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2>Laporan Barang</h2>
        <p class="text-muted">
            Daftar barang dan stok yang tersedia.
        </p>
    </div>

    <a href="{{ route('laporan.index') }}"
       class="btn btn-secondary">
        Kembali
    </a>

</div>
<div class="card p-3 mb-4">

    <form method="GET"
          action="{{ route('laporan.barang') }}">

        <div class="row align-items-end">

            <div class="col-md-4">
                <label class="form-label">
                    Dari Tanggal
                </label>

                <input type="date"
                       name="dari"
                       class="form-control"
                       value="{{ request('dari') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">
                    Sampai Tanggal
                </label>

                <input type="date"
                       name="sampai"
                       class="form-control"
                       value="{{ request('sampai') }}">
            </div>

            <div class="col-md-4">

                <button class="btn btn-primary">
                    <i class="bi bi-filter"></i>
                    Filter
                </button>

                <a href="{{ route('laporan.barang') }}"
                   class="btn btn-secondary">
                    Reset
                </a>

                <a href="{{ route('laporan.barang.export', request()->query()) }}"
                   class="btn btn-success">
                    <i class="bi bi-download"></i>
                    Export
                </a>

            </div>

        </div>

    </form>

</div>

<div class="card p-4">

    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Stok</th>
                </tr>
            </thead>

            <tbody>

                @forelse($barang as $item)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $item->kode_barang }}
                        </td>

                        <td>
                            {{ $item->nama_barang }}
                        </td>

                        <td>
                            {{ $item->category->nama_kategori ?? '-' }}
                        </td>

                        <td>
                            {{ $item->satuan }}
                        </td>

                        <td>
                            <strong>
                                {{ $item->stok }}
                            </strong>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="6"
                            class="text-center">
                            Belum ada data barang.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection