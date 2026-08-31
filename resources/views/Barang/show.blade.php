@extends('layouts.app')

@section('title', 'Detail Barang')
@section('page-title', 'Detail Barang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Detail Barang</h2>
        <p class="text-muted">Informasi lengkap barang.</p>
    </div>

    <div>
        <a href="{{ route('barang.edit', $barang) }}"
           class="btn btn-primary">
            <i class="bi bi-pencil"></i>
            Edit
        </a>

        <a href="{{ route('barang.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>
    </div>
</div>

<div class="card p-4">

    <div class="row">

        <div class="col-md-6 mb-4">
            <small class="text-muted">Kode Barang</small>
            <h5>{{ $barang->kode_barang }}</h5>
        </div>

        <div class="col-md-6 mb-4">
            <small class="text-muted">Nama Barang</small>
            <h5>{{ $barang->nama_barang }}</h5>
        </div>

        <div class="col-md-6 mb-4">
            <small class="text-muted">Kategori</small>
            <h5>{{ $barang->category->nama_kategori }}</h5>
        </div>

        <div class="col-md-3 mb-4">
            <small class="text-muted">Satuan</small>
            <h5>{{ $barang->satuan }}</h5>
        </div>

        <div class="col-md-3 mb-4">
            <small class="text-muted">Stok</small>
            <h5>
                @if($barang->stok == 0)
                    <span class="badge bg-danger">Habis</span>
                @else
                    <span class="badge bg-success">
                        {{ $barang->stok }}
                    </span>
                @endif
            </h5>
        </div>

        <div class="col-12">
            <small class="text-muted">Ditambahkan</small>
            <p>
                {{ $barang->created_at->format('d/m/Y H:i') }}
            </p>
        </div>

    </div>

</div>

@endsection