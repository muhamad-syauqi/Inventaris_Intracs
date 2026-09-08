@extends('Layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold">Dashboard Admin</h3>
    <p class="text-muted mb-0">
        Ringkasan dan aktivitas inventaris peralatan.
    </p>
</div>


{{-- STATISTIK --}}
<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="card stat-card">
            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <small class="text-muted">
                        Total Barang
                    </small>

                    <h2 class="fw-bold mt-2 mb-0">
                        {{ $totalBarang }}
                    </h2>
                </div>

                <i class="bi bi-box fs-1 text-primary"></i>

            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card stat-card">
            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <small class="text-muted">
                        Total Stok
                    </small>

                    <h2 class="fw-bold mt-2 mb-0">
                        {{ $totalStok }}
                    </h2>
                </div>

                <i class="bi bi-boxes fs-1 text-success"></i>

            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card stat-card">
            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <small class="text-muted">
                        Stok Masuk
                    </small>

                    <h2 class="fw-bold mt-2 mb-0">
                        {{ $totalStokMasuk }}
                    </h2>
                </div>

                <i class="bi bi-box-arrow-in-down fs-1 text-info"></i>

            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="card stat-card">
            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <small class="text-muted">
                        Stok Keluar
                    </small>

                    <h2 class="fw-bold mt-2 mb-0">
                        {{ $totalStokKeluar }}
                    </h2>
                </div>

                <i class="bi bi-box-arrow-up fs-1 text-warning"></i>

            </div>
        </div>
    </div>

</div>


<div class="row g-4">

    {{-- Grafik Stok --}}
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="fw-bold mb-3">
                    Grafik Stok Bulanan
                </h5>

                <div style="height: 350px;">
                    <canvas id="stokChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Pie Barang Masuk --}}
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="fw-bold mb-3">
                    Barang Masuk Bulan Ini
                </h5>

                <div style="height: 350px;">
                    <canvas id="barangPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>


{{-- AKTIVITAS --}}
<div class="card p-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h5 class="fw-bold mb-1">
                Aktivitas Terbaru
            </h5>

            <small class="text-muted">
                Aktivitas inventaris yang dilakukan pengguna
            </small>
        </div>

    </div>


    <div class="table-responsive">

        <table class="table align-middle">

            <thead>
                <tr>
                    <th>Jenis</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Dilakukan Oleh</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>

                @forelse($aktivitas as $item)

                    <tr>

                        <td>

                            @if($item['jenis'] === 'Stok Masuk')

                                <span class="badge bg-success">
                                    <i class="bi bi-arrow-down"></i>
                                    Stok Masuk
                                </span>

                            @else

                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-arrow-up"></i>
                                    Stok Keluar
                                </span>

                            @endif

                        </td>


                        <td class="fw-semibold">
                            {{ $item['barang'] }}
                        </td>


                        <td>
                            {{ $item['jumlah'] }}
                        </td>


                        <td>
                            <i class="bi bi-person-circle me-1"></i>
                            {{ $item['user'] }}
                        </td>


                        <td>
                            {{ $item['tanggal']->format('d/m/Y H:i') }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5"
                            class="text-center text-muted py-4">

                            Belum ada aktivitas.

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const grafik = @json($grafik);
const pieBarang = @json($pieBarang);

// =========================
// GRAFIK STOK
// =========================

const labels = grafik.map(item => item.bulan);
const stokMasuk = grafik.map(item => item.masuk);
const stokKeluar = grafik.map(item => item.keluar);

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
                beginAtZero: true,
                ticks: {
                    precision: 0
                }
            }
        }
    }
});


// =========================
// PIE BARANG MASUK
// =========================

new Chart(document.getElementById('barangPieChart'), {
    type: 'pie',

    data: {
        labels: pieBarang.map(item => item.nama),

        datasets: [{
            data: pieBarang.map(item => item.jumlah)
        }]
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

@endpush