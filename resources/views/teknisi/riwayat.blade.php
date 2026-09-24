@extends('layouts.app')

@section('title', 'Riwayat')
@section('page-title', 'Riwayat')

@section('content')

<style>
    .history-header {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        color: white;
        border-radius: 18px;
        padding: 25px 28px;
        margin-bottom: 24px;
    }

    .history-header h3 {
        font-weight: 700;
        margin-bottom: 5px;
    }

    .history-header p {
        margin: 0;
        opacity: .85;
    }

    .total-box {
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 14px;
        padding: 12px 20px;
        text-align: center;
        min-width: 120px;
    }

    .total-box strong {
        display: block;
        font-size: 25px;
    }

    .history-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 15px;
        box-shadow: 0 3px 15px rgba(0,0,0,.06);
        border: 1px solid #eef0f3;
    }

    .transaction-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
        background: #f8d7da;
        color: #dc3545;
    }

    .transaction-title {
        font-weight: 700;
        margin-bottom: 3px;
    }

    .transaction-code {
        color: #6c757d;
        font-size: 13px;
    }

    .badge-keluar {
        background: #f8d7da;
        color: #b02a37;
    }

    .quantity-box {
        text-align: right;
    }

    .quantity-box strong {
        font-size: 22px;
    }

    .detail-area {
        margin-top: 18px;
        padding-top: 17px;
        border-top: 1px solid #eee;
    }

    .detail-item {
        padding: 10px 12px;
        background: #f8f9fa;
        border-radius: 10px;
        height: 100%;
    }

    .detail-label {
        display: block;
        font-size: 12px;
        color: #6c757d;
        margin-bottom: 4px;
    }

    .detail-value {
        font-weight: 600;
        color: #212529;
    }

    .empty-history {
        background: white;
        border-radius: 16px;
        padding: 60px 20px;
        text-align: center;
        box-shadow: 0 3px 15px rgba(0,0,0,.06);
    }

    .empty-history i {
        font-size: 55px;
        color: #adb5bd;
    }

    @media (max-width: 768px) {

        .history-header {
            padding: 20px;
        }

        .total-box {
            margin-top: 15px;
            width: 100%;
        }

        .quantity-box {
            text-align: left;
            margin-top: 12px;
        }
    }
</style>


<div class="container-fluid">

    {{-- HEADER --}}
    <div class="history-header">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>
                <h3>
                    <i class="bi bi-clock-history me-2"></i>
                    Riwayat
                </h3>

                <p>
                    Riwayat transaksi stok keluar yang Anda lakukan
                </p>
            </div>

            <div class="total-box">
                <span>Total Riwayat</span>
                <strong>{{ $riwayat->count() }}</strong>
            </div>

        </div>

    </div>


    {{-- RIWAYAT --}}
    <div id="historyList">

        @forelse($riwayat as $item)

            <div class="history-card">

                {{-- BAGIAN ATAS --}}
                <div class="row align-items-center">

                    <div class="col-lg-6">

                        <div class="d-flex align-items-center">

                            <div class="transaction-icon">
                                <i class="bi bi-box-arrow-up"></i>
                            </div>

                            <div class="ms-3">

                                <div class="transaction-title">
                                    {{ $item->barang->nama_barang }}
                                </div>

                                <div class="transaction-code">
                                    Kode: {{ $item->barang->kode_barang }}
                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="col-lg-3 mt-2 mt-lg-0">

                        <span class="badge badge-keluar rounded-pill px-3 py-2">
                            <i class="bi bi-box-arrow-up me-1"></i>
                            Stok Keluar
                        </span>

                    </div>


                    <div class="col-lg-3 quantity-box">

                        <span class="text-muted small">
                            Jumlah
                        </span>

                        <br>

                        <strong>
                            {{ $item->jumlah }}
                        </strong>

                        <span class="text-muted">
                            {{ $item->barang->satuan }}
                        </span>

                    </div>

                </div>


                {{-- DETAIL --}}
                <div class="detail-area">

                    <div class="row g-3">

                        {{-- GERBANG --}}
                        <div class="col-12 col-md-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    <i class="bi bi-signpost-2 me-1"></i>
                                    Gerbang Tol
                                </span>

                                <span class="detail-value">
                                    {{ $item->gerbang_tol ?? '-' }}
                                </span>

                            </div>

                        </div>


                        {{-- GARDU --}}
                        <div class="col-12 col-md-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    <i class="bi bi-building me-1"></i>
                                    Nomor Gardu
                                </span>

                                <span class="detail-value">

                                    @if($item->nomor_gardu)
                                        Gardu {{ $item->nomor_gardu }}
                                    @else
                                        -
                                    @endif

                                </span>

                            </div>

                        </div>


                        {{-- KETERANGAN --}}
                        <div class="col-12 col-md-8">

                            <div class="detail-item">

                                <span class="detail-label">
                                    <i class="bi bi-chat-left-text me-1"></i>
                                    Keterangan
                                </span>

                                <span class="detail-value">
                                    {{ $item->keterangan ?? '-' }}
                                </span>

                            </div>

                        </div>


                        {{-- TANGGAL INPUT --}}
                        <div class="col-12 col-md-4">

                            <div class="detail-item">

                                <span class="detail-label">
                                    <i class="bi bi-clock me-1"></i>
                                    Diinput pada
                                </span>

                                <span class="detail-value">

                                    {{ $item->created_at->format('d M Y') }}

                                    <br>

                                    <small class="text-muted">
                                        {{ $item->created_at->format('H:i') }} WIB
                                    </small>

                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="empty-history">

                <i class="bi bi-clock-history"></i>

                <h5 class="mt-3 fw-bold">
                    Belum Ada Riwayat
                </h5>

                <p class="text-muted mb-0">
                    Transaksi stok keluar yang Anda lakukan akan muncul di halaman ini.
                </p>

            </div>

        @endforelse

        @if($riwayat->hasPages())
        <div class="d-flex justify-content-center mt-4">
                {{ $riwayat->links() }}
        </div>
        @endif

    </div>

</div>

@endsection