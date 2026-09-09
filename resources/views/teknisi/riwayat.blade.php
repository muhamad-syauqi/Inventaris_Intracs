@extends('layouts.app')

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

    .filter-box {
        background: white;
        border-radius: 15px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 3px 15px rgba(0,0,0,.06);
    }

    .filter-btn {
        border-radius: 10px;
        padding: 8px 18px;
        border: none;
        background: #f1f3f5;
        color: #555;
        margin-right: 6px;
    }

    .filter-btn.active {
        background: #0d6efd;
        color: white;
    }

    .history-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 15px;
        box-shadow: 0 3px 15px rgba(0,0,0,.06);
        border: 1px solid #eef0f3;
        transition: .2s;
    }

    .history-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,.09);
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
    }

    .icon-masuk {
        background: #d1e7dd;
        color: #198754;
    }

    .icon-keluar {
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

    .badge-masuk {
        background: #d1e7dd;
        color: #146c43;
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

    .date-box {
        color: #6c757d;
        font-size: 13px;
        text-align: right;
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

        .quantity-box,
        .date-box {
            text-align: left;
            margin-top: 12px;
        }

        .filter-btn {
            margin-bottom: 7px;
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
                    Riwayat Saya
                </h3>

                <p>
                    Riwayat transaksi stok yang Anda input
                </p>
            </div>

            <div class="total-box">
                <span>Total Aktivitas</span>
                <strong>{{ $riwayat->count() }}</strong>
            </div>

        </div>

    </div>


    {{-- FILTER --}}
    <div class="filter-box">

        <button class="filter-btn active"
                onclick="filterHistory('semua', this)">
            <i class="bi bi-list me-1"></i>
            Semua
        </button>

        <button class="filter-btn"
                onclick="filterHistory('masuk', this)">
            <i class="bi bi-box-arrow-in-down me-1"></i>
            Stok Masuk
        </button>

        <button class="filter-btn"
                onclick="filterHistory('keluar', this)">
            <i class="bi bi-box-arrow-up me-1"></i>
            Stok Keluar
        </button>

    </div>


    {{-- RIWAYAT --}}
    <div id="historyList">

        @forelse($riwayat as $item)

            <div class="history-card history-item"
                 data-type="{{ $item->jenis === 'Stok Masuk' ? 'masuk' : 'keluar' }}">

                {{-- BAGIAN ATAS --}}
                <div class="row align-items-center">

                    <div class="col-lg-6">

                        <div class="d-flex align-items-center">

                            <div class="transaction-icon
                                {{ $item->jenis === 'Stok Masuk'
                                    ? 'icon-masuk'
                                    : 'icon-keluar' }}">

                                @if($item->jenis === 'Stok Masuk')
                                    <i class="bi bi-box-arrow-in-down"></i>
                                @else
                                    <i class="bi bi-box-arrow-up"></i>
                                @endif

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

                        @if($item->jenis === 'Stok Masuk')

                            <span class="badge badge-masuk rounded-pill px-3 py-2">
                                <i class="bi bi-box-arrow-in-down me-1"></i>
                                Stok Masuk
                            </span>

                        @else

                            <span class="badge badge-keluar rounded-pill px-3 py-2">
                                <i class="bi bi-box-arrow-up me-1"></i>
                                Stok Keluar
                            </span>

                        @endif

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

                        @if($item->jenis === 'Stok Masuk')

                            {{-- NOMOR DO --}}
                            <div class="col-md-4">

                                <div class="detail-item">

                                    <span class="detail-label">
                                        <i class="bi bi-file-earmark-text me-1"></i>
                                        Nomor DO
                                    </span>

                                    <span class="detail-value">
                                        {{ $item->nomor_do ?? '-' }}
                                    </span>

                                </div>

                            </div>


                            {{-- TANGGAL REQUEST --}}
                            <div class="col-md-4">

                                <div class="detail-item">

                                    <span class="detail-label">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        Tanggal Request
                                    </span>

                                    <span class="detail-value">

                                        @if($item->tanggal_request)

                                            {{ \Carbon\Carbon::parse($item->tanggal_request)->format('d M Y') }}

                                        @else

                                            -

                                        @endif

                                    </span>

                                </div>

                            </div>


                            {{-- NAMA REQUEST --}}
                            <div class="col-md-4">

                                <div class="detail-item">

                                    <span class="detail-label">
                                        <i class="bi bi-person me-1"></i>
                                        Nama yang Request
                                    </span>

                                    <span class="detail-value">
                                        {{ $item->nama_request ?? '-' }}
                                    </span>

                                </div>

                            </div>

                        @else

                            {{-- GERBANG --}}
                            <div class="col-md-6">

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
                            <div class="col-md-6">

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

                        @endif


                        {{-- KETERANGAN --}}
                        <div class="col-md-8">

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
                        <div class="col-md-4">

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
                    Transaksi yang Anda input akan muncul di halaman ini.
                </p>

            </div>

        @endforelse

    </div>

</div>


<script>

function filterHistory(type, button) {

    const items = document.querySelectorAll('.history-item');

    const buttons = document.querySelectorAll('.filter-btn');

    buttons.forEach(btn => {
        btn.classList.remove('active');
    });

    button.classList.add('active');

    items.forEach(item => {

        if (type === 'semua') {

            item.style.display = '';

        } else {

            if (item.dataset.type === type) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }

        }

    });

}

</script>

@endsection