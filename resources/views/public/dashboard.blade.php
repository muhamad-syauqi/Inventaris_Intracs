<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inventaris Intracs</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f8fc;
            color: #172033;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar-custom {
            height: 76px;
            background: rgba(255,255,255,.96);
            border-bottom: 1px solid #e8edf5;
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .navbar-inner {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #172033;
        }

        .brand-logo {
            height: 44px;
            width: auto;
            object-fit: contain;
        }

        .brand-name {
            font-size: 19px;
            font-weight: 700;
            letter-spacing: -.3px;
        }

        .brand-subtitle {
            font-size: 11px;
            color: #8792a5;
            display: block;
            margin-top: -2px;
        }

        .login-btn {
            border: none;
            background: #1769e0;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            transition: .2s;
        }

        .login-btn:hover {
            background: #0e56bf;
            color: white;
            transform: translateY(-1px);
        }

        /* =========================
           HERO
        ========================= */

        .hero {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #0e56bf 0%, #1769e0 50%, #4b9cff 100%);
            color: white;
            padding: 72px 0 85px;
        }

        .hero::before {
            content: "";
            position: absolute;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: rgba(255,255,255,.08);
            right: -120px;
            top: -220px;
        }

        .hero::after {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(255,255,255,.06);
            left: -100px;
            bottom: -160px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 760px;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 13px;
            border-radius: 30px;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.2);
            font-size: 13px;
            margin-bottom: 20px;
        }

        .hero h1 {
            font-size: clamp(36px, 5vw, 58px);
            line-height: 1.08;
            font-weight: 800;
            letter-spacing: -1.5px;
            margin-bottom: 18px;
        }

        .hero p {
            font-size: 17px;
            line-height: 1.7;
            color: rgba(255,255,255,.88);
            max-width: 650px;
            margin-bottom: 28px;
        }

        .hero-button {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: white;
            color: #1769e0;
            padding: 12px 20px;
            border-radius: 11px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s;
        }

        .hero-button:hover {
            color: #0e56bf;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,.15);
        }

        /* =========================
           STATISTICS
        ========================= */

        .stats-wrapper {
            margin-top: -42px;
            position: relative;
            z-index: 10;
        }

        .stat-card {
            height: 100%;
            background: white;
            border-radius: 16px;
            padding: 22px;
            border: 1px solid #e8edf5;
            box-shadow: 0 10px 30px rgba(27,55,95,.08);
            transition: .2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(27,55,95,.12);
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
            margin-bottom: 15px;
        }

        .icon-blue {
            background: #e8f1ff;
            color: #1769e0;
        }

        .icon-green {
            background: #e8f8ef;
            color: #15945b;
        }

        .icon-orange {
            background: #fff3df;
            color: #e99000;
        }

        .icon-red {
            background: #ffebed;
            color: #df3b4c;
        }

        .stat-number {
            font-size: 29px;
            font-weight: 800;
            color: #172033;
            line-height: 1;
        }

        .stat-label {
            color: #7c8799;
            font-size: 13px;
            margin-top: 8px;
        }

        /* =========================
           MAIN CONTENT
        ========================= */

        .section {
            padding: 65px 0;
        }

        .section-heading {
            margin-bottom: 28px;
        }

        .section-heading h2 {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 7px;
        }

        .section-heading p {
            color: #7c8799;
            margin: 0;
        }

        /* =========================
           SEARCH
        ========================= */

        .search-card {
            background: white;
            border: 1px solid #e8edf5;
            border-radius: 16px;
            padding: 18px;
            margin-bottom: 25px;
        }

        .search-form {
            display: flex;
            gap: 10px;
        }

        .search-input {
            height: 48px;
            border: 1px solid #dfe5ee;
            border-radius: 10px;
            padding: 0 16px;
            flex: 1;
            outline: none;
        }

        .search-input:focus {
            border-color: #1769e0;
            box-shadow: 0 0 0 3px rgba(23,105,224,.1);
        }

        .search-btn {
            border: none;
            background: #1769e0;
            color: white;
            padding: 0 22px;
            border-radius: 10px;
            font-weight: 600;
        }

        /* =========================
           INVENTORY TABLE
        ========================= */

        .inventory-card {
            background: white;
            border: 1px solid #e8edf5;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(27,55,95,.04);
        }

        .table {
            margin: 0;
        }

        .table thead th {
            background: #f8faff;
            color: #68758a;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .5px;
            font-weight: 700;
            padding: 16px 18px;
            border-bottom: 1px solid #e8edf5;
        }

        .table tbody td {
            padding: 17px 18px;
            vertical-align: middle;
            border-color: #edf1f6;
        }

        .item-name {
            font-weight: 700;
            color: #202b3d;
        }

        .item-code {
            color: #8792a5;
            font-size: 12px;
            margin-top: 3px;
        }

        .category-badge {
            display: inline-block;
            background: #eef4ff;
            color: #1769e0;
            padding: 5px 9px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
        }

        .stock-number {
            font-weight: 800;
            font-size: 17px;
        }

        .stock-unit {
            font-size: 12px;
            color: #8792a5;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 10px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-available {
            color: #128052;
            background: #e8f8ef;
        }

        .status-low {
            color: #c47700;
            background: #fff4df;
        }

        .status-empty {
            color: #d23849;
            background: #ffebed;
        }

        /* =========================
           EMPTY
        ========================= */

        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: #8994a7;
        }

        .empty-icon {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: #f0f4fa;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 27px;
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            background: #111827;
            color: white;
            padding: 35px 0;
            margin-top: 20px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
        }

        .footer-logo {
            height: 34px;
            width: auto;
            background: white;
            padding: 3px;
            border-radius: 6px;
        }

        .footer-text {
            color: #9ca8ba;
            font-size: 13px;
            margin-top: 10px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 767px) {

            .navbar-custom {
                height: 68px;
            }

            .brand-logo {
                height: 36px;
            }

            .brand-name {
                font-size: 16px;
            }

            .brand-subtitle {
                display: none;
            }

            .login-btn {
                padding: 8px 13px;
                font-size: 13px;
            }

            .hero {
                padding: 55px 0 75px;
            }

            .hero h1 {
                font-size: 38px;
            }

            .hero p {
                font-size: 15px;
            }

            .stats-wrapper {
                margin-top: -30px;
            }

            .stat-card {
                padding: 17px;
            }

            .stat-number {
                font-size: 24px;
            }

            .section {
                padding: 45px 0;
            }

            .section-heading h2 {
                font-size: 24px;
            }

            .search-form {
                flex-direction: column;
            }

            .search-input {
                width: 100%;
            }

            .search-btn {
                height: 45px;
            }

            .table {
                min-width: 760px;
            }

            .inventory-card {
                overflow-x: auto;
            }
        }

        @media (max-width: 400px) {

            .brand-name {
                font-size: 14px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .hero-button {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

<!-- =========================
     NAVBAR
========================= -->

<nav class="navbar-custom">
    <div class="container navbar-inner">

        <a href="{{ route('public.dashboard') }}" class="brand">

            <img
                src="{{ asset('images/intracs.png') }}"
                alt="Logo Intracs"
                class="brand-logo"
            >

            <div>
                <div class="brand-name">
                    Inventaris Intracs
                </div>

                <span class="brand-subtitle">
                    Sistem Informasi Inventaris
                </span>
            </div>

        </a>

        <a href="{{ route('login') }}" class="login-btn">
            <i class="bi bi-box-arrow-in-right"></i>
            Login
        </a>

    </div>
</nav>


<!-- =========================
     HERO
========================= -->

<section class="hero">

    <div class="container">

        <div class="hero-content">

            <div class="hero-label">
                <i class="bi bi-box-seam"></i>
                Sistem Inventaris
            </div>

            <h1>
                Informasi Ketersediaan
                Barang Secara Mudah
            </h1>

            <p>
                Pantau ketersediaan barang inventaris secara cepat
                dan terorganisir. Gunakan pencarian untuk menemukan
                barang yang dibutuhkan.
            </p>

            <a href="#inventaris" class="hero-button">
                Lihat Inventaris
                <i class="bi bi-arrow-down"></i>
            </a>

        </div>

    </div>

</section>


<!-- =========================
     STATISTICS
========================= -->

<section class="stats-wrapper">

    <div class="container">

        <div class="row g-3">

            <div class="col-6 col-lg-3">
                <div class="stat-card">

                    <div class="stat-icon icon-blue">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <div class="stat-number">
                        {{ $totalBarang }}
                    </div>

                    <div class="stat-label">
                        Jenis Barang
                    </div>

                </div>
            </div>


            <div class="col-6 col-lg-3">
                <div class="stat-card">

                    <div class="stat-icon icon-green">
                        <i class="bi bi-stack"></i>
                    </div>

                    <div class="stat-number">
                        {{ $totalStok }}
                    </div>

                    <div class="stat-label">
                        Total Stok
                    </div>

                </div>
            </div>


            <div class="col-6 col-lg-3">
                <div class="stat-card">

                    <div class="stat-icon icon-orange">
                        <i class="bi bi-check-circle"></i>
                    </div>

                    <div class="stat-number">
                        {{ $barangTersedia }}
                    </div>

                    <div class="stat-label">
                        Barang Tersedia
                    </div>

                </div>
            </div>


            <div class="col-6 col-lg-3">
                <div class="stat-card">

                    <div class="stat-icon icon-red">
                        <i class="bi bi-exclamation-circle"></i>
                    </div>

                    <div class="stat-number">
                        {{ $barangHabis }}
                    </div>

                    <div class="stat-label">
                        Stok Habis
                    </div>

                </div>
            </div>

        </div>

    </div>

</section>


<!-- =========================
     INVENTORY
========================= -->

<section class="section" id="inventaris">

    <div class="container">

        <div class="section-heading">

            <h2>
                Ketersediaan Inventaris
            </h2>

            <p>
                Daftar barang yang tersedia di dalam sistem inventaris.
            </p>

        </div>


        <!-- SEARCH -->

        <div class="search-card">

            <form
                action="{{ route('public.dashboard') }}"
                method="GET"
                class="search-form"
            >

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="search-input"
                    placeholder="Cari nama barang atau kode barang..."
                >

                <button type="submit" class="search-btn">
                    <i class="bi bi-search"></i>
                    Cari
                </button>

            </form>

        </div>


        <!-- TABLE -->

        <div class="inventory-card">

            @if($barang->count())

                <table class="table">

                    <thead>

                        <tr>
                            <th>Barang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($barang as $item)

                            <tr>

                                <td>

                                    <div class="item-name">
                                        {{ $item->nama_barang }}
                                    </div>

                                    <div class="item-code">
                                        Kode: {{ $item->kode_barang }}
                                    </div>

                                </td>


                                <td>

                                    <span class="category-badge">

                                        {{ $item->category->nama_kategori ?? '-' }}

                                    </span>

                                </td>


                                <td>

                                    <span class="stock-number">
                                        {{ $item->stok }}
                                    </span>

                                    <span class="stock-unit">
                                        {{ $item->satuan }}
                                    </span>

                                </td>


                                <td>

                                    @if($item->stok <= 0)

                                        <span class="status status-empty">
                                            <span class="status-dot"></span>
                                            Habis
                                        </span>

                                    @elseif($item->stok <= 5)

                                        <span class="status status-low">
                                            <span class="status-dot"></span>
                                            Stok Menipis
                                        </span>

                                    @else

                                        <span class="status status-available">
                                            <span class="status-dot"></span>
                                            Tersedia
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <h5>
                        Barang tidak ditemukan
                    </h5>

                    <p>
                        Coba gunakan nama atau kode barang yang berbeda.
                    </p>

                </div>

            @endif

        </div>


        <!-- PAGINATION -->

        @if($barang->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $barang->links() }}

            </div>

        @endif

    </div>

</section>


<!-- =========================
     FOOTER
========================= -->

<footer>

    <div class="container">

        <div class="footer-brand">

            <img
                src="{{ asset('images/intracs.png') }}"
                alt="Logo Intracs"
                class="footer-logo"
            >

            <span>
                Inventaris Intracs
            </span>

        </div>

        <div class="footer-text">
            Sistem informasi inventaris untuk membantu pemantauan
            ketersediaan barang secara terorganisir.
        </div>

        <div class="footer-text">
            Cabang Purbaleunyi dan Sekitarnya.
        </div>

        <div class="footer-text">
            © {{ date('Y') }} Inventaris Intracs. All rights reserved.
        </div>

    </div>

</footer>


</body>
</html>