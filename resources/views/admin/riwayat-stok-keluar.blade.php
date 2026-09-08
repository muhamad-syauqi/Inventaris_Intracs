@extends('layouts.app')

@section('title', 'Riwayat Stok Keluar')
@section('page-title', 'Riwayat Stok Keluar')

@section('content')

<div class="mb-4">
    <h2>Riwayat Stok Keluar</h2>
    <p class="text-muted">
        Melihat seluruh aktivitas stok keluar yang dilakukan oleh teknisi.
    </p>
</div>

<div class="card border-0 shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Dikeluarkan Oleh</th>
                        <th>Tanggal & Jam</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($stokKeluar as $item)

                        <tr>

                            <td>
                                {{ $stokKeluar->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <strong>
                                    {{ $item->barang->nama_barang ?? '-' }}
                                </strong>
                                <br>

                                <small class="text-muted">
                                    {{ $item->barang->kode_barang ?? '-' }}
                                </small>
                            </td>

                            <td>
                                <span class="badge bg-danger">
                                    -{{ $item->jumlah }}
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
                            <td colspan="6"
                                class="text-center text-muted py-5">

                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>

                                Belum ada riwayat stok keluar.

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">
            {{ $stokKeluar->links() }}
        </div>

    </div>

</div>

@endsection