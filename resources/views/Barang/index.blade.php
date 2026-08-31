@extends('layouts.app')

@section('title', 'Barang')
@section('page-title', 'Barang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2>Daftar Barang</h2>
        <p class="text-muted">
            Daftar seluruh barang yang tersedia dalam inventaris.
        </p>
    </div>

    <a href="{{ route('barang.create') }}"
       class="btn btn-primary">
        <i class="bi bi-plus-lg"></i>
        Tambah Barang
    </a>

</div>

<div class="card p-4">

    <form method="GET" class="row g-3 mb-4">

        <div class="col-md-7">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari nama barang / kode barang..."
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-3">

            <select name="kategori_id" class="form-select">

                <option value="">Semua Kategori</option>

                @foreach($categories as $category)

                    <option value="{{ $category->id }}"
                        {{ request('kategori_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nama_kategori }}
                    </option>

                @endforeach

            </select>

        </div>

        <div class="col-md-2">

            <button class="btn btn-primary w-100">
                <i class="bi bi-search"></i>
                Cari
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
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($barang as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->kode_barang }}</td>

                    <td>{{ $item->nama_barang }}</td>

                    <td>{{ $item->category->nama_kategori }}</td>

                    <td>{{ $item->satuan }}</td>

                    <td>

                        @if($item->stok == 0)

                            <span class="badge bg-danger badge-stock">
                                Habis
                            </span>

                        @elseif($item->stok <= 10)

                            <span class="badge bg-warning text-dark badge-stock">
                                {{ $item->stok }}
                            </span>

                        @else

                            <span class="badge bg-success badge-stock">
                                {{ $item->stok }}
                            </span>

                        @endif

                    </td>

                    <td>
                        <a href="{{ route('barang.show', $item) }}"
                           class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('barang.edit', $item) }}"
                           class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('barang.destroy', $item) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Hapus barang ini?')">
                                <i class="bi bi-trash"></i>
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="text-center py-4">
                        Belum ada data barang.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    {{ $barang->links() }}

</div>

@endsection