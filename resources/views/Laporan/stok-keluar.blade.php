@extends('layouts.app')

@section('title', 'Laporan Stok Keluar')
@section('page-title', 'Laporan Stok Keluar')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2>Laporan Stok Keluar</h2>
        <p class="text-muted">
            Riwayat stok barang yang keluar.
        </p>
    </div>

    <a href="{{ route('laporan.index') }}"
       class="btn btn-secondary">
        Kembali
    </a>

</div>
<div class="card p-3 mb-4">

    <form method="GET"
          action="{{ route('laporan.stok-keluar') }}">

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

                <a href="{{ route('laporan.stok-keluar') }}"
                   class="btn btn-secondary">
                    Reset
                </a>

                <a href="{{ route('laporan.stok-keluar.export', request()->query()) }}"
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
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>

                @forelse($stokKeluar as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $item->barang->kode_barang ?? '-' }}
                        </td>

                        <td>
                            {{ $item->barang->nama_barang ?? '-' }}
                        </td>

                        <td>
                            <strong class="text-danger">
                                -{{ $item->jumlah }}
                            </strong>
                        </td>

                        <td>
                            {{ $item->keterangan ?? '-' }}
                        </td>

                        <td>
                            {{ $item->created_at->format('d/m/Y H:i') }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6"
                            class="text-center">
                            Belum ada transaksi stok keluar.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection