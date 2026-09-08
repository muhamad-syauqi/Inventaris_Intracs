@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')

<div class="mb-4">

    <h2 class="fw-bold">
        Dashboard Admin
    </h2>

    <p class="text-muted">
        Pantau data inventaris dan aktivitas teknisi.
    </p>

</div>


{{-- ========================================= --}}
{{-- STATISTIK --}}
{{-- ========================================= --}}

<div class="row g-4 mb-4">

    {{-- TOTAL BARANG --}}
    <div class="col-md-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <p class="text-muted mb-1">
                            Total Barang
                        </p>

                        <h2 class="fw-bold mb-0">
                            {{ $totalBarang }}
                        </h2>

                    </div>

                    <i class="bi bi-box-seam fs-1 text-primary"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- TOTAL STOK --}}
    <div class="col-md-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <p class="text-muted mb-1">
                            Total Stok
                        </p>

                        <h2 class="fw-bold mb-0">
                            {{ $totalStok }}
                        </h2>

                    </div>

                    <i class="bi bi-stack fs-1 text-success"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- STOK MASUK --}}
    <div class="col-md-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <p class="text-muted mb-1">
                            Total Stok Masuk
                        </p>

                        <h2 class="fw-bold mb-0">
                            {{ $totalStokMasuk }}
                        </h2>

                    </div>

                    <i class="bi bi-arrow-down-circle fs-1 text-success"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- STOK KELUAR --}}
    <div class="col-md-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <p class="text-muted mb-1">
                            Total Stok Keluar
                        </p>

                        <h2 class="fw-bold mb-0">
                            {{ $totalStokKeluar }}
                        </h2>

                    </div>

                    <i class="bi bi-arrow-up-circle fs-1 text-danger"></i>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- ========================================= --}}
{{-- GRAFIK --}}
{{-- ========================================= --}}

<div class="row g-4 mb-4">

    {{-- GRAFIK BATANG --}}
    <div class="col-lg-8">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <h5 class="fw-bold mb-1">
                    Grafik Stok Bulanan
                </h5>

                <p class="text-muted">
                    Perbandingan stok masuk dan stok keluar.
                </p>

                <div style="height: 350px;">

                    <canvas id="stokChart"></canvas>

                </div>

            </div>

        </div>

    </div>


    {{-- PIE CHART --}}
    <div class="col-lg-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <h5 class="fw-bold mb-1">
                    Barang Masuk Bulan Ini
                </h5>

                <p class="text-muted">
                    Berdasarkan jumlah barang yang masuk.
                </p>

                <div style="height: 350px;">

                    <canvas id="barangPieChart"></canvas>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- ========================================= --}}
{{-- AKTIVITAS --}}
{{-- ========================================= --}}

<div class="card border-0 shadow-sm">

    <div class="card-body">

        <h5 class="fw-bold mb-1">
            Aktivitas Terbaru
        </h5>

        <p class="text-muted mb-4">
            Aktivitas transaksi yang dilakukan oleh teknisi.
        </p>


        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>No</th>
                        <th>Jenis</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Dilakukan Oleh</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($aktivitas as $item)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>


                            <td>

                                @if($item->jenis === 'Stok Masuk')

                                    <span class="badge bg-success">
                                        <i class="bi bi-arrow-down"></i>
                                        Stok Masuk
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        <i class="bi bi-arrow-up"></i>
                                        Stok Keluar
                                    </span>

                                @endif

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

                                @if($item->jenis === 'Stok Masuk')

                                    <span class="text-success fw-bold">
                                        +{{ $item->jumlah }}
                                    </span>

                                @else

                                    <span class="text-danger fw-bold">
                                        -{{ $item->jumlah }}
                                    </span>

                                @endif

                            </td>


                            <td>

                                <i class="bi bi-person-circle me-1"></i>

                                {{ $item->user->name ?? '-' }}

                            </td>


                            <td>
                                {{ $item->keterangan ?? '-' }}
                            </td>


                            <td>
                                {{ $item->created_at->format('d-m-Y H:i') }}
                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center text-muted py-5">

                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>

                                Belum ada aktivitas transaksi.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- ========================================= --}}
{{-- CHART.JS --}}
{{-- ========================================= --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const grafik = @json($grafik);

const labels = grafik.map(item => item.bulan);

const stokMasuk = grafik.map(item => item.masuk);

const stokKeluar = grafik.map(item => item.keluar);


// Grafik Stok
new Chart(document.getElementById('stokChart'), {

    type: 'bar',

    data: {

        labels: labels,

        datasets: [

            {
                label: 'Stok Masuk',
                data: stokMasuk
            },

            {
                label: 'Stok Keluar',
                data: stokKeluar
            }

        ]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        scales: {

            y: {
                beginAtZero: true
            }

        }

    }

});


// Pie Chart
const pieBarang = @json($pieBarang);

new Chart(document.getElementById('barangPieChart'), {

    type: 'pie',

    data: {

        labels: pieBarang.map(item => item.nama),

        datasets: [

            {
                data: pieBarang.map(item => item.jumlah)
            }

        ]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {
                position: 'bottom'
            }

        }

    }

});

</script>

@endsection