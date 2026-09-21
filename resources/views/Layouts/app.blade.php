<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Inventaris Peralatan')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            max-width: 100%;
            overflow-x: hidden;
        }

        body {
            background: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        /* =========================
           SIDEBAR DESKTOP
           ========================= */

        .sidebar {
            width: 245px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #08213f;
            color: white;
            padding: 25px 15px;
            z-index: 1050;
            overflow-y: auto;
        }

        .brand {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 35px;
            line-height: 1.3;
        }

        .sidebar a {
            color: #dbe5f1;
            text-decoration: none;
            display: block;
            padding: 13px 15px;
            border-radius: 8px;
            margin-bottom: 7px;
            transition: .2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #1473e6;
            color: white;
        }

        .sidebar i {
            margin-right: 10px;
        }

        .sidebar-logout {
            position: absolute;
            bottom: 25px;
            left: 15px;
            right: 15px;
        }

        /* =========================
           MAIN
           ========================= */

        .main {
            margin-left: 245px;
            min-height: 100vh;
            width: calc(100% - 245px);
        }

        .topbar {
            height: 75px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .content {
            padding: 30px;
            width: 100%;
        }

        /* =========================
           CARD
           ========================= */

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0,0,0,.05);
            max-width: 100%;
        }

        .stat-card {
            padding: 22px;
        }

        /* =========================
           TABLE
           ========================= */

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            min-width: 650px;
        }

        .table th {
            background: #f1f5f9;
            white-space: nowrap;
        }

        /* =========================
           BUTTON
           ========================= */

        .btn-primary {
            background: #1473e6;
            border-color: #1473e6;
        }

        .badge-stock {
            padding: 7px 12px;
            border-radius: 7px;
        }

        /* =========================
           MOBILE HEADER BUTTON
           ========================= */

        .mobile-menu-btn {
            display: none;
        }

        /* =========================
           MOBILE
           ========================= */

        @media (max-width: 991.98px) {

            .sidebar {
                width: 270px;
                transform: translateX(-100%);
                transition: transform .3s ease;
                box-shadow: 5px 0 20px rgba(0,0,0,.15);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                height: 65px;
                padding: 0 18px;
                gap: 10px;
            }

            .mobile-menu-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 42px;
                height: 42px;
                border: none;
                border-radius: 8px;
                background: #1473e6;
                color: white;
                font-size: 20px;
            }

            .topbar-left {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .topbar-title {
                font-size: 17px;
            }

            .topbar-user {
                font-size: 14px;
            }

            .content {
                padding: 20px;
            }

            /* Overlay */

            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,.45);
                z-index: 1040;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }

        /* =========================
           SMALL PHONE
           ========================= */

        @media (max-width: 575.98px) {

            .sidebar {
                width: 250px;
            }

            .topbar {
                height: 60px;
                padding: 0 12px;
            }

            .mobile-menu-btn {
                width: 38px;
                height: 38px;
                font-size: 18px;
            }

            .topbar-title {
                font-size: 15px;
            }

            .topbar-user {
                font-size: 13px;
            }

            .topbar-user .bi-bell {
                display: none;
            }

            .content {
                padding: 15px;
            }

            .card-body {
                padding: 15px;
            }

            .table {
                font-size: 13px;
            }

            .btn {
                font-size: 14px;
            }

            h1 {
                font-size: 24px;
            }

            h2 {
                font-size: 21px;
            }

            h3 {
                font-size: 19px;
            }

            h4 {
                font-size: 18px;
            }

            h5 {
                font-size: 16px;
            }

            .alert {
                font-size: 14px;
            }
        }

        /* =========================
           FORM RESPONSIVE
           ========================= */

        .form-control,
        .form-select {
            max-width: 100%;
        }

        /* =========================
           IMAGE & CHART
           ========================= */

        img {
            max-width: 100%;
            height: auto;
        }

        canvas {
            max-width: 100% !important;
        }

        /* =====================================================
           RESPONSIVE PAGES - MOBILE ONLY
           Desktop appearance remains unchanged.
           ===================================================== */

        @media (max-width: 767.98px) {

            /* General page spacing */
            .content > .container-fluid {
                padding-left: 0 !important;
                padding-right: 0 !important;
            }

            /* Page headers used by history pages */
            .page-header {
                padding: 18px !important;
                border-radius: 14px !important;
            }

            .page-header h3 {
                font-size: 20px;
            }

            /* Cards used by history/report pages */
            .filter-card,
            .table-card {
                padding: 14px !important;
                border-radius: 12px !important;
            }

            .stat-card {
                padding: 15px !important;
            }

            /* Make filter/export controls stack naturally */
            .filter-card .d-flex.gap-2 {
                flex-wrap: wrap;
            }

            .filter-card .d-flex.gap-2 .btn {
                flex: 1 1 auto;
            }

            /* History tables remain readable and scroll horizontally */
            .table-responsive {
                border-radius: 8px;
            }

            .table-responsive > .table {
                min-width: 720px;
            }

            /* Dashboard chart cards */
            .chart-container,
            .chart-box {
                width: 100% !important;
                max-width: 100% !important;
            }

            /* Forms */
            .card.p-4 {
                padding: 18px !important;
            }

            /* Headers with a button: stack on narrow screens */
            .content .d-flex.justify-content-between.align-items-center.mb-4 {
                flex-wrap: wrap;
                gap: 12px;
            }

            .content .d-flex.justify-content-between.align-items-center.mb-4 > * {
                max-width: 100%;
            }

            .content .d-flex.justify-content-between.align-items-center.mb-4 > a.btn {
                width: 100%;
            }

            /* Pagination */
            .pagination {
                flex-wrap: wrap;
            }

            /* Action buttons */
            .btn-group {
                flex-wrap: wrap;
            }
        }

        @media (max-width: 575.98px) {

            /* Compact mobile typography */
            .content h2 {
                font-size: 21px;
            }

            .content h3 {
                font-size: 19px;
            }

            .content h4 {
                font-size: 18px;
            }

            /* History export buttons */
            .filter-card .mt-3.pt-3.border-top {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                gap: 6px;
            }

            .filter-card .mt-3.pt-3.border-top .me-2 {
                width: 100%;
                margin-right: 0 !important;
                margin-bottom: 2px;
            }

            /* Keep card contents inside viewport */
            .card {
                max-width: 100%;
                overflow: hidden;
            }

            /* Buttons in forms */
            .card form .btn {
                min-height: 40px;
            }

            /* Long headings */
            .page-header p {
                font-size: 14px;
            }
        }

    </style>

    @stack('styles')
</head>

<body>

{{-- OVERLAY MOBILE --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>


{{-- =========================
     SIDEBAR
     ========================= --}}

<div class="sidebar" id="sidebar">

    <div class="brand">
        <i class="bi bi-box-seam"></i>
        INVENTARIS<br>
        PERALATAN
    </div>


    {{-- ================= ADMIN ================= --}}

    @if(auth()->user()->role === 'admin')

        <a href="{{ route('admin.dashboard') }}"
           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid"></i>
            Dashboard
        </a>

        <a href="{{ route('barang.index') }}"
           class="{{ request()->routeIs('barang.*') ? 'active' : '' }}">
            <i class="bi bi-box"></i>
            Barang
        </a>

        <a href="{{ route('stok-masuk.tambah-stok') }}"
            class="{{ request()->routeIs('stok-masuk.*') ? 'active' : '' }}">
                <i class="bi bi-box-arrow-in-down"></i>
             Tambah Stok
        </a>

        <a href="{{ route('admin.riwayat-stok-masuk') }}"
           class="{{ request()->routeIs('admin.riwayat-stok-masuk') ? 'active' : '' }}">
            <i class="bi bi-box-arrow-in-down"></i>
            Riwayat Stok Masuk
        </a>

        <a href="{{ route('admin.riwayat-stok-keluar') }}"
           class="{{ request()->routeIs('admin.riwayat-stok-keluar') ? 'active' : '' }}">
            <i class="bi bi-box-arrow-up"></i>
            Riwayat Stok Keluar
        </a>


    {{-- ================= TEKNISI ================= --}}

    @elseif(auth()->user()->role === 'teknisi')

        <a href="{{ route('teknisi.dashboard') }}"
           class="{{ request()->routeIs('teknisi.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid"></i>
            Dashboard
        </a>

        <a href="{{ route('stok-keluar.index') }}"
           class="{{ request()->routeIs('stok-keluar.*') ? 'active' : '' }}">
            <i class="bi bi-box-arrow-up"></i>
            Stok Keluar
        </a>

        <a href="{{ route('teknisi.riwayat') }}"
           class="{{ request()->routeIs('teknisi.riwayat') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i>
            Riwayat Saya
        </a>

    @endif


    {{-- ================= LOGOUT ================= --}}

    <div class="sidebar-logout">

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                    class="btn btn-link text-white text-decoration-none w-100 text-start p-0">

                <i class="bi bi-box-arrow-right"></i>
                Logout

            </button>

        </form>

    </div>

</div>


{{-- =========================
     MAIN CONTENT
     ========================= --}}

<div class="main">

    <div class="topbar">

        <div class="topbar-left">

            {{-- Tombol menu HP --}}
            <button class="mobile-menu-btn"
                    type="button"
                    id="mobileMenuBtn"
                    aria-label="Buka menu">

                <i class="bi bi-list"></i>

            </button>

            <h5 class="mb-0 topbar-title">
                @yield('page-title')
            </h5>

        </div>


        <div class="topbar-user">

            <i class="bi bi-bell fs-5 me-3"></i>

            <strong>
                {{ auth()->user()->name ?? 'Admin' }}
            </strong>

        </div>

    </div>


    <div class="content">

        @if(session('success'))

            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i>
                {{ session('success') }}
            </div>

        @endif


        @if(session('error'))

            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle"></i>
                {{ session('error') }}
            </div>

        @endif


        @yield('content')

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

    const menuBtn = document.getElementById('mobileMenuBtn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function openSidebar() {
        sidebar.classList.add('show');
        overlay.classList.add('show');
    }

    function closeSidebar() {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    }

    if (menuBtn) {
        menuBtn.addEventListener('click', function () {
            if (sidebar.classList.contains('show')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });
    }

    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }

    // Tutup sidebar setelah memilih menu di HP
    document.querySelectorAll('.sidebar a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 991) {
                closeSidebar();
            }
        });
    });

</script>

@stack('scripts')

</body>
</html>