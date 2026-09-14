<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Inventaris Peralatan - Informasi Barang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body {
            background: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        .navbar-custom {
            background: #08213f;
        }

        .hero {
            background: linear-gradient(
                135deg,
                #08213f,
                #1473e6
            );

            color: white;
            padding: 70px 0;
        }

        .hero h1 {
            font-weight: 700;
        }

        .hero p {
            color: #dbe5f1;
            max-width: 650px;
        }

        .stat-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 18px rgba(0,0,0,.06);
            transition: .2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .icon-box {
            width: 50px;
            height: 50px;
            border-radius: 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 22px;
        }

        .table-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;

            box-shadow: 0 4px 18px rgba(0,0,0,.06);
        }

        .table thead th {
            background: #f1f5f9;
            border: none;
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
        }

        .badge-stock {
            padding: 8px 12px;
            border-radius: 8px;
        }

        .footer {
            background: #08213f;
            color: #dbe5f1;
            padding: 25px 0;
            margin-top: 60px;
        }

    </style>

</head>


<body>


{{-- NAVBAR --}}

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">

    <div class="container">

        <a class="navbar-brand fw-bold"
           href="{{ route('public.dashboard') }}">

            <i class="bi bi-box-seam me-2"></i>

            INVENTARIS PERALATAN

        </a>


        <a href="{{ route('login') }}"
           class="btn btn-light">

            <i class="bi bi-box-arrow-in-right me-1"></i>

            Login

        </a>

    </div>

</nav>



{{-- HERO --}}

<section class="hero">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <span class="badge bg-light text-primary mb-3 px-3 py-2">

                    SISTEM INVENTARIS

                </span>


                <h1 class="display-5 mb-3">

                    Informasi Persediaan Barang

                </h1>


                <p class="lead mb-4">

                    Lihat informasi ketersediaan barang inventaris
                    sebelum masuk ke dalam sistem.

                </p>


                <a href="{{ route('login') }}"
                   class="btn btn-light btn-lg px-4">

                    <i class="bi bi-box-arrow-in-right me-2"></i>

                    Masuk ke Sistem

                </a>

            </div>


            <div class="col-lg-4 text-center d-none d-lg-block">

                <i class="bi bi-box-seam"
                   style="font-size: 150px; opacity:.2;">
                </i>

            </div>

        </div>

    </div>

</section>



{{-- STATISTIK --}}

<div class="container"
     style="margin-top:-35px;">

    <div class="row g-4">


        {{-- TOTAL BARANG --}}

        <div class="col-md-3">

            <div class="card stat-card p-4 h-100">

                <div class="d-flex align-items-center">

                    <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">

                        <i class="bi bi-box-seam"></i>

                    </div>

                    <div>

                        <small class="text-muted">
                            Jenis Barang
                        </small>

                        <h3 class="fw-bold mb-0">
                            {{ $totalBarang }}
                        </h3>

                    </div>

                </div>

            </div>

        </div>


        {{-- TOTAL STOK --}}

        <div class="col-md-3">

            <div class="card stat-card p-4 h-100">

                <div class="d-flex align-items-center">

                    <div class="icon-box bg-success bg-opacity-10 text-success me-3">

                        <i class="bi bi-boxes"></i>

                    </div>

                    <div>

                        <small class="text-muted">
                            Total Stok
                        </small>

                        <h3 class="fw-bold mb-0">
                            {{ $totalStok }}
                        </h3>

                    </div>

                </div>

            </div>

        </div>


        {{-- TERSEDIA --}}

        <div class="col-md-3">

            <div class="card stat-card p-4 h-100">

                <div class="d-flex align-items-center">

                    <div class="icon-box bg-info bg-opacity-10 text-info me-3">

                        <i class="bi bi-check-circle"></i>

                    </div>

                    <div>

                        <small class="text-muted">
                            Barang Tersedia
                        </small>

                        <h3 class="fw-bold mb-0">
                            {{ $barangTersedia }}
                        </h3>

                    </div>

                </div>

            </div>

        </div>


        {{-- HABIS --}}

        <div class="col-md-3">

            <div class="card stat-card p-4 h-100">

                <div class="d-flex align-items-center">

                    <div class="icon-box bg-danger bg-opacity-10 text-danger me-3">

                        <i class="bi bi-exclamation-circle"></i>

                    </div>

                    <div>

                        <small class="text-muted">
                            Stok Habis
                        </small>

                        <h3 class="fw-bold mb-0">
                            {{ $barangHabis }}
                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



{{-- DAFTAR BARANG --}}

<div class="container mt-5">

    <div class="d-flex justify-content-between
                align-items-center mb-3">

        <div>

            <h3 class="fw-bold mb-1">
                Ketersediaan Barang
            </h3>

            <p class="text-muted mb-0">
                Daftar barang yang tersedia dalam inventaris.
            </p>

        </div>

        <span class="text-muted">
            {{ $barang->total() }} data
        </span>

    </div>


    <div class="card table-card">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Kode Barang</th>

                        <th>Nama Barang</th>

                        <th>Kategori</th>

                        <th>Satuan</th>

                        <th class="text-center">
                            Ketersediaan
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($barang as $item)

                    <tr>

                        <td>

                            {{ $barang->firstItem() + $loop->index }}

                        </td>


                        <td>

                            <span class="fw-semibold">

                                {{ $item->kode_barang }}

                            </span>

                        </td>


                        <td>

                            <i class="bi bi-box-seam
                                      text-primary me-2">
                            </i>

                            {{ $item->nama_barang }}

                        </td>


                        <td>

                            @if($item->category)

                                <span class="badge bg-light
                                             text-dark border">

                                    {{ $item->category->nama_kategori }}

                                </span>

                            @else

                                <span class="text-muted">
                                    -
                                </span>

                            @endif

                        </td>


                        <td>

                            {{ $item->satuan }}

                        </td>


                        <td class="text-center">

                            @if($item->stok > 0)

                                <span class="badge bg-success badge-stock">

                                    <i class="bi bi-check-circle me-1"></i>

                                    Tersedia

                                </span>

                            @else

                                <span class="badge bg-danger badge-stock">

                                    <i class="bi bi-x-circle me-1"></i>

                                    Habis

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="text-center py-5">

                            <i class="bi bi-box-seam
                                      text-muted"
                               style="font-size:45px;">
                            </i>

                            <p class="text-muted mt-3 mb-0">

                                Belum ada data barang.

                            </p>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        @if($barang->hasPages())

            <div class="p-4">

                {{ $barang->links() }}

            </div>

        @endif

    </div>

</div>



{{-- FOOTER --}}

<footer class="footer">

    <div class="container text-center">

        <div class="fw-bold mb-1">

            <i class="bi bi-box-seam me-2"></i>

            INVENTARIS PERALATAN

        </div>

        <small>

            Sistem Informasi Inventaris Peralatan

        </small>

    </div>

</footer>


</body>

</html>