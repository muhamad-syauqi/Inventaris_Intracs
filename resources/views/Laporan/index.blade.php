@extends('layouts.app')

@section('title', 'Laporan')
@section('page-title', 'Laporan')

@section('content')

<div class="mb-4">

    <h2>Laporan Inventaris</h2>

    <p class="text-muted">
        Menampilkan laporan stok barang, stok masuk, dan stok keluar.
    </p>

</div>


{{-- LAPORAN STOK BARANG --}}

<div class="card p-4 mb-4">

    <div class="d-flex justify-content-between mb-3">

        <div>

            <h5>Laporan Stok Barang</h5>

            <small class="text-muted">
                Kondisi stok barang saat ini.
            </small>

        </div>

        <button class="btn btn-success btn-sm">
            <i class="bi bi-file-earmark-excel"></i>
            Export Excel
        </button>

    </div>

    <form method="GET" class="row g-3 mb-3">

        <div class="col-md-6">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari barang...">

        </div>

        <div class="col-md-3">

            <select name="barang_id"
                    class="form-select">

                <option value="">
                    Semua Barang
                </option>

                @foreach($daftarBarang as $item)

                    <option value="{{ $item->id }}">
                        {{ $item->nama_barang }}
                    </option>

                @endforeach

            </select>

        </div>

        <div class="col-md-3">

            <button class="btn btn-primary w-100">
                <i class="bi bi-filter"></i>
                Filter
            </button>

        </div>

    </form>

    <div class="table-responsive">

        <table class="table align-middle">

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

            @foreach($barang as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->kode_barang }}</td>

                    <td>{{ $item->nama_barang }}</td>

                    <td>{{ $item->category->nama_kategori }}</td>

                    <td>{{ $item->satuan }}</td>

                    <td>

                        @if($item->stok == 0)

                            <span class="badge bg-danger">
                                Habis
                            </span>

                        @else

                            <span class="badge bg-success">
                                {{ $item->stok }}
                            </span>

                        @endif

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

    {{ $barang->links() }}

</div>


{{-- LAPORAN STOK MASUK --}}

<div class="card p-4 mb-4">

    <div class="d-flex justify-content-between mb-3">

        <div>

            <h5>Laporan Stok Masuk</h5>

            <small class="text-muted">
                Riwayat barang yang masuk.
            </small>

        </div>

        <div>

            <button class="btn btn-success btn-sm">
                <i class="bi bi-file-earmark-excel"></i>
                Excel
            </button>

            <button class="btn btn-danger btn-sm">
                <i class="bi bi-file-earmark-pdf"></i>
                PDF
            </button>

        </div>

    </div>

    <form method="GET" class="row g-3 mb-3">

        <div class="col-md-4">

            <label>Periode Awal</label>

            <input type="date"
                   name="tanggal_mulai"
                   class="form-control">

        </div>

        <div class="col-md-4">

            <label>Periode Akhir</label>

            <input type="date"
                   name="tanggal_akhir"
                   class="form-control">

        </div>

        <div class="col-md-4 d-flex align-items-end">

            <button class="btn btn-primary w-100">
                Filter
            </button>

        </div>

    </form>

    <div class="table-responsive">

        <table class="table align-middle">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Tanggal & Waktu</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Masuk</th>
                    <th>Satuan</th>
                    <th>Keterangan</th>

                </tr>

            </thead>

            <tbody>

            @forelse($stokMasuk as $data)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $data->created_at->format('d/m/Y H:i') }}
                    </td>

                    <td>
                        {{ $data->barang->kode_barang }}
                    </td>

                    <td>
                        {{ $data->barang->nama_barang }}
                    </td>

                    <td>
                        {{ $data->jumlah }}
                    </td>

                    <td>
                        {{ $data->barang->satuan }}
                    </td>

                    <td>
                        {{ $data->keterangan ?? '-' }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7"
                        class="text-center">

                        Belum ada transaksi stok masuk.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    {{ $stokMasuk->links() }}

</div>


{{-- LAPORAN STOK KELUAR --}}

<div class="card p-4">

    <div class="d-flex justify-content-between mb-3">

        <div>

            <h5>Laporan Stok Keluar</h5>

            <small class="text-muted">
                Riwayat barang yang keluar.
            </small>

        </div>

        <div>

            <button class="btn btn-success btn-sm">
                <i class="bi bi-file-earmark-excel"></i>
                Excel
            </button>

            <button class="btn btn-danger btn-sm">
                <i class="bi bi-file-earmark-pdf"></i>
                PDF
            </button>

        </div>

    </div>

    <div class="table-responsive">

        <table class="table align-middle">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Tanggal & Waktu</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Keluar</th>
                    <th>Satuan</th>
                    <th>Keterangan</th>

                </tr>

            </thead>

            <tbody>

            @forelse($stokKeluar as $data)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $data->created_at->format('d/m/Y H:i') }}
                    </td>

                    <td>
                        {{ $data->barang->kode_barang }}
                    </td>

                    <td>
                        {{ $data->barang->nama_barang }}
                    </td>

                    <td>
                        {{ $data->jumlah }}
                    </td>

                    <td>
                        {{ $data->barang->satuan }}
                    </td>

                    <td>
                        {{ $data->keterangan ?? '-' }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7"
                        class="text-center">

                        Belum ada transaksi stok keluar.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    {{ $stokKeluar->links() }}

</div>

@endsection