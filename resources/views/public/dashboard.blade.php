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
        :root {
            --blue-dark: #03151d;
            --blue-deep: #062b3a;
            --blue: #0b5874;
            --blue-main: #0d789e;
            --blue-light: #28b8e8;
            --cyan: #63dcff;

            --text: #eefaff;
            --muted: #8baab7;

            --glass: rgba(8, 35, 46, .68);
            --glass-border: rgba(82, 190, 226, .18);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            color: var(--text);
            font-family: "Segoe UI", Arial, sans-serif;
            background:
                radial-gradient(
                    circle at 15% 10%,
                    rgba(15, 132, 174, .20),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 85% 35%,
                    rgba(25, 174, 219, .13),
                    transparent 30%
                ),
                var(--blue-dark);
            overflow-x: hidden;
        }

        /* =========================
           BACKGROUND ANIMATION
        ========================= */

        .background-glow {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: -1;
            overflow: hidden;
        }

        .glow {
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            filter: blur(90px);
            opacity: .18;
            animation: floatGlow 12s ease-in-out infinite alternate;
        }

        .glow.one {
            background: #087ca3;
            top: -180px;
            left: -100px;
        }

        .glow.two {
            background: #20c4f0;
            right: -150px;
            top: 35%;
            animation-delay: 2s;
        }

        .glow.three {
            background: #07516d;
            left: 30%;
            bottom: -230px;
            animation-delay: 4s;
        }

        @keyframes floatGlow {
            from {
                transform: translate(0, 0) scale(1);
            }

            to {
                transform: translate(70px, -40px) scale(1.2);
            }
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar-custom {
            position: sticky;
            top: 14px;
            z-index: 1000;
            margin: 14px auto 0;
            width: min(1180px, calc(100% - 30px));

            background: rgba(4, 25, 34, .72);
            border: 1px solid var(--glass-border);
            border-radius: 20px;

            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);

            box-shadow:
                0 15px 50px rgba(0, 0, 0, .25),
                inset 0 1px rgba(255, 255, 255, .05);

            animation: navbarIn .7s ease;
        }

        @keyframes navbarIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navbar-inner {
            min-height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 18px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
        }

        .brand-logo {
            width: 45px;
            height: 45px;
            object-fit: contain;
            filter:
                drop-shadow(0 0 10px rgba(53, 202, 245, .35));
        }

        .brand-name {
            font-size: 18px;
            font-weight: 750;
        }

        .brand-subtitle {
            display: block;
            color: var(--muted);
            font-size: 11px;
        }

        .login-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 10px 18px;
            border-radius: 12px;

            color: white;
            text-decoration: none;
            font-weight: 700;

            background:
                linear-gradient(
                    135deg,
                    #07506a,
                    #0d8bb5
                );

            border: 1px solid rgba(95, 215, 247, .28);

            box-shadow:
                0 0 20px rgba(21, 160, 205, .15);

            transition: .25s;
        }

        .login-btn:hover {
            color: white;
            transform: translateY(-2px);

            box-shadow:
                0 0 30px rgba(35, 191, 235, .35);
        }

        /* =========================
           HERO
        ========================= */

        .hero {
            position: relative;
            min-height: 570px;
            display: flex;
            align-items: center;
            overflow: hidden;
            padding: 100px 0 130px;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            max-width: 730px;

            animation: heroIn 1s ease;
        }

        @keyframes heroIn {
            from {
                opacity: 0;
                transform: translateY(35px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 8px 14px;
            margin-bottom: 22px;

            border-radius: 30px;
            color: #8de7ff;

            background: rgba(17, 125, 162, .13);
            border: 1px solid rgba(69, 195, 232, .20);

            box-shadow:
                0 0 25px rgba(19, 145, 187, .08);
        }

        .hero-label i {
            color: var(--cyan);
        }

        .hero h1 {
            margin: 0 0 20px;

            font-size: clamp(42px, 6vw, 70px);
            line-height: 1.02;
            font-weight: 850;
            letter-spacing: -2.5px;
        }

        .hero h1 span {
            background:
                linear-gradient(
                    90deg,
                    #ffffff,
                    #63dcff,
                    #159dcc
                );

            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero p {
            max-width: 650px;
            color: #a5c0cb;
            font-size: 17px;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .hero-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;

            padding: 13px 20px;
            border-radius: 13px;

            color: white;
            text-decoration: none;
            font-weight: 700;

            background:
                linear-gradient(
                    135deg,
                    #07536e,
                    #0e91bb
                );

            border: 1px solid rgba(100, 218, 250, .28);

            box-shadow:
                0 10px 35px rgba(0, 135, 180, .20);

            transition: .25s;
        }

        .hero-button:hover {
            color: white;
            transform: translateY(-3px);

            box-shadow:
                0 15px 45px rgba(0, 169, 220, .35);
        }

        /* Decorative lines */

        .hero-orb {
            position: absolute;
            width: 530px;
            height: 530px;
            border-radius: 50%;

            right: -130px;
            top: 30px;

            border: 1px solid rgba(69, 201, 238, .16);

            box-shadow:
                0 0 80px rgba(16, 152, 199, .08),
                inset 0 0 80px rgba(16, 152, 199, .05);

            animation: rotateOrb 18s linear infinite;
        }

        .hero-orb::before,
        .hero-orb::after {
            content: "";
            position: absolute;
            inset: 45px;
            border-radius: 50%;
            border: 1px solid rgba(75, 208, 242, .12);
        }

        .hero-orb::after {
            inset: 100px;
        }

        @keyframes rotateOrb {
            from {
                transform: rotate(0);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* =========================
           STATISTICS
        ========================= */

        .stats-wrapper {
            position: relative;
            z-index: 10;
            margin-top: -55px;
        }

        .stat-card {
            position: relative;
            height: 100%;

            padding: 23px;
            border-radius: 19px;

            background:
                linear-gradient(
                    145deg,
                    rgba(14, 54, 69, .78),
                    rgba(5, 28, 38, .74)
                );

            border: 1px solid var(--glass-border);

            backdrop-filter: blur(18px);

            box-shadow:
                0 20px 45px rgba(0, 0, 0, .20);

            overflow: hidden;

            transition: .3s;
        }

        .stat-card::before {
            content: "";
            position: absolute;
            width: 130px;
            height: 130px;
            right: -70px;
            top: -70px;

            background: rgba(34, 186, 232, .12);
            border-radius: 50%;
            filter: blur(10px);
        }

        .stat-card:hover {
            transform: translateY(-7px);

            border-color: rgba(62, 202, 239, .35);

            box-shadow:
                0 25px 55px rgba(0, 0, 0, .28),
                0 0 30px rgba(16, 159, 204, .08);
        }

        .stat-icon {
            width: 48px;
            height: 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 14px;
            margin-bottom: 18px;

            font-size: 21px;

            background: rgba(24, 148, 187, .14);
            color: var(--cyan);

            border: 1px solid rgba(64, 198, 235, .14);
        }

        .icon-green {
            color: #54e6aa;
            background: rgba(42, 198, 133, .10);
        }

        .icon-orange {
            color: #ffc766;
            background: rgba(241, 168, 51, .10);
        }

        .icon-red {
            color: #ff7181;
            background: rgba(232, 65, 87, .10);
        }

        .stat-number {
            font-size: 30px;
            line-height: 1;
            font-weight: 850;
            color: white;
        }

        .stat-label {
            margin-top: 8px;
            color: var(--muted);
            font-size: 13px;
        }

        /* =========================
           MAIN
        ========================= */

        .section {
            padding: 90px 0;
        }

        .section-heading {
            margin-bottom: 30px;
        }

        .section-heading h2 {
            margin-bottom: 8px;

            font-size: 31px;
            font-weight: 850;
            letter-spacing: -.8px;
        }

        .section-heading h2 span {
            color: var(--cyan);
        }

        .section-heading p {
            margin: 0;
            color: var(--muted);
        }

        /* =========================
           SEARCH
        ========================= */

        .search-card {
            padding: 15px;
            margin-bottom: 24px;

            border-radius: 18px;

            background: rgba(7, 35, 46, .68);
            border: 1px solid var(--glass-border);

            backdrop-filter: blur(18px);

            box-shadow:
                0 15px 40px rgba(0, 0, 0, .16);
        }

        .search-form {
            display: flex;
            gap: 10px;
        }

        .search-input {
            flex: 1;
            height: 50px;

            padding: 0 17px;

            color: white;
            background: rgba(2, 19, 26, .70);

            border: 1px solid rgba(99, 201, 230, .15);
            border-radius: 13px;

            outline: none;
        }

        .search-input::placeholder {
            color: #6f8b97;
        }

        .search-input:focus {
            border-color: rgba(63, 203, 241, .50);

            box-shadow:
                0 0 0 4px rgba(23, 159, 202, .08),
                0 0 25px rgba(23, 159, 202, .08);
        }

        .search-btn {
            height: 50px;

            border: 0;
            border-radius: 13px;

            padding: 0 22px;

            color: white;
            font-weight: 700;

            background:
                linear-gradient(
                    135deg,
                    #07536d,
                    #0c8caf
                );

            box-shadow:
                0 8px 25px rgba(7, 142, 185, .16);

            transition: .25s;
        }

        .search-btn:hover {
            transform: translateY(-2px);

            box-shadow:
                0 12px 30px rgba(10, 169, 219, .28);
        }

        /* =========================
           TABLE
        ========================= */

        .inventory-card {
            overflow: hidden;

            border-radius: 20px;

            background: rgba(7, 32, 42, .72);
            border: 1px solid var(--glass-border);

            backdrop-filter: blur(18px);

            box-shadow:
                0 20px 50px rgba(0, 0, 0, .18);
        }

        .table {
            margin: 0;
            color: white;
        }

        .table thead th {
            padding: 17px 19px;

            color: #83a5b2;
            background: rgba(11, 68, 87, .35);

            border-bottom: 1px solid rgba(89, 192, 222, .12);

            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .table tbody td {
            padding: 18px 19px;
            vertical-align: middle;

            color: #dcecf2;

            background: transparent;
            border-color: rgba(105, 174, 197, .08);
        }

        .table tbody tr {
            transition: .25s;
        }

        .table tbody tr:hover td {
            background: rgba(20, 145, 184, .07);
        }

        .item-name {
            color: white;
            font-weight: 750;
        }

        .item-code {
            margin-top: 4px;
            color: #718f9c;
            font-size: 12px;
        }

        .category-badge {
            display: inline-block;

            padding: 6px 10px;

            border-radius: 8px;

            color: #70dcfa;
            background: rgba(21, 143, 182, .12);

            border: 1px solid rgba(69, 196, 232, .12);

            font-size: 12px;
            font-weight: 650;
        }

        .stock-number {
            color: white;
            font-size: 17px;
            font-weight: 800;
        }

        .stock-unit {
            color: #718f9c;
            font-size: 12px;
        }

        /* =========================
           STATUS
        ========================= */

        .status {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            padding: 7px 11px;

            border-radius: 30px;

            font-size: 11px;
            font-weight: 750;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;

            box-shadow: 0 0 9px currentColor;
        }

        .status-available {
            color: #58e7ad;
            background: rgba(44, 198, 133, .10);
            border: 1px solid rgba(69, 226, 161, .12);
        }

        .status-low {
            color: #ffc766;
            background: rgba(238, 163, 45, .10);
            border: 1px solid rgba(244, 184, 83, .12);
        }

        .status-empty {
            color: #ff6f7e;
            background: rgba(232, 64, 85, .10);
            border: 1px solid rgba(240, 80, 99, .12);
        }

        /* =========================
           EMPTY
        ========================= */

        .empty-state {
            padding: 70px 20px;
            text-align: center;
            color: var(--muted);
        }

        .empty-icon {
            width: 70px;
            height: 70px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 17px;

            border-radius: 50%;

            color: var(--cyan);
            background: rgba(25, 146, 185, .10);

            border: 1px solid rgba(70, 198, 233, .12);

            font-size: 27px;
        }

        .empty-state h5 {
            color: white;
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            position: relative;
            overflow: hidden;

            padding: 45px 0;

            background: rgba(2, 15, 21, .92);
            border-top: 1px solid rgba(84, 184, 214, .10);
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 10px;

            color: white;
            font-weight: 750;
        }

        .footer-logo {
            width: 38px;
            height: 38px;
            object-fit: contain;

            filter:
                drop-shadow(0 0 10px rgba(49, 197, 238, .30));
        }

        .footer-text {
            margin-top: 9px;
            color: #66828e;
            font-size: 13px;
        }

        /* =========================
           REVEAL ANIMATION
        ========================= */

        .reveal {
            opacity: 0;
            transform: translateY(25px);
            transition: .7s ease;
        }

        .reveal.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 767px) {

            .navbar-custom {
                width: calc(100% - 20px);
                top: 10px;
                margin-top: 10px;
            }

            .navbar-inner {
                min-height: 64px;
            }

            .brand-logo {
                width: 38px;
                height: 38px;
            }

            .brand-name {
                font-size: 15px;
            }

            .brand-subtitle {
                display: none;
            }

            .login-btn {
                padding: 8px 12px;
                font-size: 12px;
            }

            .hero {
                min-height: auto;
                padding: 80px 0 105px;
            }

            .hero h1 {
                font-size: 40px;
                letter-spacing: -1.5px;
            }

            .hero p {
                font-size: 15px;
            }

            .hero-orb {
                width: 330px;
                height: 330px;
                right: -180px;
                top: 100px;
                opacity: .6;
            }

            .stats-wrapper {
                margin-top: -45px;
            }

            .stat-card {
                padding: 18px;
            }

            .stat-number {
                font-size: 25px;
            }

            .section {
                padding: 65px 0;
            }

            .section-heading h2 {
                font-size: 25px;
            }

            .search-form {
                flex-direction: column;
            }

            .search-btn {
                width: 100%;
            }

            .inventory-card {
                overflow-x: auto;
            }

            .table {
                min-width: 760px;
            }
        }

        @media (max-width: 400px) {

            .hero h1 {
                font-size: 34px;
            }

            .hero-button {
                width: 100%;
                justify-content: center;
            }
        }

        </style>
    </head>

    <body>

    <div class="background-glow">
        <div class="glow one"></div>
        <div class="glow two"></div>
        <div class="glow three"></div>
    </div>


<!-- =========================
     NAVBAR
========================= -->

<nav class="navbar-custom">

    <div class="navbar-inner">

        <a
            href="{{ route('public.dashboard') }}"
            class="brand"
        >

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


        <a
            href="{{ route('login') }}"
            class="login-btn"
        >
            <i class="bi bi-box-arrow-in-right"></i>
            Login
        </a>

    </div>

</nav>


<!-- =========================
     HERO
========================= -->

<section class="hero">

    <div class="hero-orb"></div>

    <div class="container">

        <div class="hero-content">

            <div class="hero-label">
                <i class="bi bi-shield-check"></i>
                Sistem Inventaris Intracs
            </div>


            <h1>
                Kelola Inventaris
                <span>Lebih Modern.</span>
            </h1>


            <p>
                Pantau ketersediaan barang inventaris secara cepat,
                terorganisir, dan mudah. Cari barang berdasarkan
                nama atau kode untuk mendapatkan informasi stok.
            </p>


            <a
                href="#inventaris"
                class="hero-button"
            >
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

            <div class="col-6 col-lg-3 reveal">

                <div class="stat-card">

                    <div class="stat-icon">
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


            <div class="col-6 col-lg-3 reveal">

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


            <div class="col-6 col-lg-3 reveal">

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


            <div class="col-6 col-lg-3 reveal">

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

<section
    class="section"
    id="inventaris"
>

    <div class="container">

        <div class="section-heading reveal">

            <h2>
                Ketersediaan <span>Inventaris</span>
            </h2>

            <p>
                Daftar barang yang tersedia di dalam sistem inventaris.
            </p>

        </div>


        <!-- SEARCH -->

        <div class="search-card reveal">

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


                <button
                    type="submit"
                    class="search-btn"
                >

                    <i class="bi bi-search"></i>
                    Cari

                </button>

            </form>

        </div>


        <!-- TABLE -->

        <div class="inventory-card reveal">

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
                                        Kode:
                                        {{ $item->kode_barang }}
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
            Sistem informasi inventaris untuk membantu
            pemantauan ketersediaan barang secara terorganisir.
        </div>


        <div class="footer-text">
            Cabang Purbaleunyi dan Sekitarnya.
        </div>


        <div class="footer-text">
            © {{ date('Y') }}
            Inventaris Intracs.
            All rights reserved.
        </div>

    </div>
</footer>


<script>
    /*
    ==========================================
    REVEAL ANIMATION
    ==========================================
    */

    const revealElements =
        document.querySelectorAll('.reveal');

    const observer =
        new IntersectionObserver(
            (entries) => {

                entries.forEach((entry) => {

                    if (entry.isIntersecting) {

                        entry.target.classList.add('show');

                        observer.unobserve(entry.target);
                    }

                });

            },
            {
                threshold: .12
            }
        );


    revealElements.forEach((element) => {

        observer.observe(element);

    });
</script>


</body>
</html>