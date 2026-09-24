<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Inventaris Intracs')
    </title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>

        /* =====================================================
           GLOBAL
        ===================================================== */

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
            overflow-x: hidden;
        }

        body {
            background: #f5f7fb;
            color: #1f2937;
            font-family: "Segoe UI", Arial, sans-serif;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;

            width: 250px;
            height: 100vh;

            background: #ffffff;

            border-right: 1px solid #e8edf3;

            display: flex;
            flex-direction: column;

            z-index: 1100;

            transition:
                transform .3s ease,
                box-shadow .3s ease;
        }


        /* Logo */

        .sidebar-header {
            height: 76px;

            padding: 0 22px;

            display: flex;
            align-items: center;

            border-bottom: 1px solid #edf0f5;

            flex-shrink: 0;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;

            gap: 10px;

            text-decoration: none;
            color: #172033;

            min-width: 0;
        }

        .sidebar-logo {
            width: 40px;
            height: 40px;

            object-fit: contain;

            flex-shrink: 0;
        }

        .brand-text {
            min-width: 0;
        }

        .brand-title {
            font-size: 17px;
            font-weight: 700;

            white-space: nowrap;
        }

        .brand-subtitle {
            font-size: 10px;
            color: #8a94a6;

            white-space: nowrap;
        }


        /* =====================================================
           SIDEBAR MENU
        ===================================================== */

        .sidebar-menu {
            flex: 1;

            overflow-y: auto;
            overflow-x: hidden;

            padding: 18px 13px 12px;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: #d8dee8;
            border-radius: 10px;
        }

        .menu-label {
            padding: 8px 12px;

            font-size: 10px;
            font-weight: 700;

            color: #9aa4b2;

            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;

            width: 100%;

            min-height: 46px;

            padding: 11px 13px;

            margin-bottom: 5px;

            border-radius: 10px;

            color: #667085;

            text-decoration: none;

            font-size: 14px;
            font-weight: 500;

            transition:
                background .2s ease,
                color .2s ease,
                transform .2s ease;
        }

        .sidebar-menu a i {
            width: 22px;

            margin-right: 10px;

            font-size: 17px;

            flex-shrink: 0;
        }

        .sidebar-menu a:hover {
            background: #f0f5ff;
            color: #1769e0;

            transform: translateX(2px);
        }

        .sidebar-menu a.active {
            background: #1769e0;
            color: #ffffff;

            box-shadow: 0 5px 12px rgba(23, 105, 224, .18);
        }


        /* =====================================================
           LOGOUT
        ===================================================== */

        .sidebar-footer {
            flex-shrink: 0;

            padding: 12px 13px 15px;

            border-top: 1px solid #edf0f5;

            background: #ffffff;
        }

        .logout-button {
            width: 100%;

            display: flex;
            align-items: center;

            min-height: 46px;

            padding: 11px 13px;

            border: none;
            border-radius: 10px;

            background: transparent;

            color: #dc3545;

            font-size: 14px;
            font-weight: 600;

            text-align: left;

            cursor: pointer;

            transition: .2s;
        }

        .logout-button i {
            width: 22px;

            margin-right: 10px;

            font-size: 17px;
        }

        .logout-button:hover {
            background: #fff0f1;
            color: #c82333;
        }


        /* =====================================================
           OVERLAY
        ===================================================== */

        .sidebar-overlay {
            display: none;

            position: fixed;

            inset: 0;

            background: rgba(15, 23, 42, .45);

            z-index: 1050;
        }

        .sidebar-overlay.show {
            display: block;
        }


        /* =====================================================
           MAIN CONTENT
        ===================================================== */

        .main-content {
            min-height: 100vh;

            margin-left: 250px;

            width: calc(100% - 250px);
        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {
            height: 76px;

            background: #ffffff;

            border-bottom: 1px solid #e8edf3;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 30px;

            position: sticky;
            top: 0;

            z-index: 900;
        }

        .topbar-left {
            display: flex;
            align-items: center;

            min-width: 0;
        }

        .mobile-menu-button {
            display: none;

            width: 42px;
            height: 42px;

            border: 1px solid #e2e7ef;

            background: #ffffff;

            border-radius: 10px;

            align-items: center;
            justify-content: center;

            color: #344054;

            font-size: 20px;

            cursor: pointer;
        }

        .page-heading {
            min-width: 0;
        }

        .page-heading h5 {
            margin: 0;

            font-size: 17px;
            font-weight: 700;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .page-heading small {
            color: #98a2b3;
            font-size: 12px;
        }


        /* User */

        .topbar-user {
            display: flex;
            align-items: center;

            gap: 10px;

            flex-shrink: 0;
        }

        .user-avatar {
            width: 38px;
            height: 38px;

            border-radius: 50%;

            background: #eaf2ff;

            color: #1769e0;

            display: flex;
            align-items: center;
            justify-content: center;

            font-weight: 700;
        }

        .user-info {
            line-height: 1.2;
        }

        .user-name {
            font-size: 13px;
            font-weight: 700;
        }

        .user-role {
            font-size: 11px;
            color: #98a2b3;
            text-transform: capitalize;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content-wrapper {
            padding: 30px;
        }


        /* =====================================================
           RESPONSIVE TABLE
        ===================================================== */

        .table-responsive {
            width: 100%;

            overflow-x: auto;

            -webkit-overflow-scrolling: touch;
        }

        .table-responsive table {
            min-width: 650px;
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 991.98px) {

            /* Sidebar */

            .sidebar {
                width: 280px;

                transform: translateX(-100%);

                box-shadow: none;
            }

            .sidebar.show {
                transform: translateX(0);

                box-shadow: 10px 0 30px rgba(0,0,0,.12);
            }


            /* Main */

            .main-content {
                margin-left: 0;

                width: 100%;
            }


            /* Topbar */

            .topbar {
                height: 68px;

                padding: 0 18px;
            }

            .mobile-menu-button {
                display: flex;

                margin-right: 12px;
            }


            /* Content */

            .content-wrapper {
                padding: 22px 18px;
            }
        }


        /* =====================================================
           MOBILE SMALL
        ===================================================== */

        @media (max-width: 575.98px) {

            .sidebar {
                width: min(290px, 88vw);
            }

            .sidebar-header {
                height: 68px;

                padding: 0 18px;
            }

            .sidebar-logo {
                width: 36px;
                height: 36px;
            }

            .brand-title {
                font-size: 16px;
            }


            .topbar {
                padding: 0 13px;
            }

            .mobile-menu-button {
                width: 40px;
                height: 40px;

                margin-right: 9px;
            }

            .page-heading h5 {
                font-size: 15px;
            }

            .page-heading small {
                display: none;
            }


            /* Hide detailed user info */

            .user-info {
                display: none;
            }

            .user-avatar {
                width: 36px;
                height: 36px;
            }


            .content-wrapper {
                padding: 17px 13px;
            }


            /* Cards */

            .card {
                border-radius: 12px;
            }

            .card-body {
                padding: 16px;
            }


            /* Buttons */

            .btn {
                min-height: 40px;
            }


            /* Form */

            .form-control,
            .form-select {
                min-height: 43px;
            }


            /* Table */

            .table-responsive table {
                min-width: 700px;
            }
        }


        /* =====================================================
           VERY SMALL SCREEN
        ===================================================== */

        @media (max-width: 360px) {

            .sidebar {
                width: 86vw;
            }

            .content-wrapper {
                padding: 14px 10px;
            }

            .topbar {
                padding: 0 10px;
            }

            .mobile-menu-button {
                margin-right: 7px;
            }

            .page-heading h5 {
                font-size: 14px;
            }
        }

    </style>

    @stack('styles')
</head>

<body>


<!-- =========================================================
     OVERLAY
========================================================= -->

<div
    id="sidebarOverlay"
    class="sidebar-overlay"
    onclick="closeSidebar()">
</div>


<!-- =========================================================
     SIDEBAR
========================================================= -->

<aside id="sidebar" class="sidebar">


    <!-- LOGO -->

    <div class="sidebar-header">

        <a
            href="{{ auth()->check()
                ? (auth()->user()->role === 'admin'
                    ? route('admin.dashboard')
                    : route('teknisi.dashboard'))
                : route('public.dashboard') }}"
            class="sidebar-brand"
        >

            <!--
                Jika memiliki logo:
                public/images/logo.png
            -->

            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logo Intracs"
                class="sidebar-logo"
                onerror="this.style.display='none'"
            >

            <div class="brand-text">

                <div class="brand-title">
                    Inventaris Intracs
                </div>

                <div class="brand-subtitle">
                    Sistem Informasi Inventaris
                </div>

            </div>

        </a>

    </div>


    <!-- =====================================================
         MENU
    ===================================================== -->

    <div class="sidebar-menu">


        @if(auth()->check() && auth()->user()->role === 'admin')

            <div class="menu-label">
                Menu Admin
            </div>


            <!-- Dashboard -->

            <a
                href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                onclick="closeSidebarMobile()"
            >

                <i class="bi bi-grid"></i>

                <span>
                    Dashboard
                </span>

            </a>


            <!-- Barang -->

            <a
                href="{{ route('barang.index') }}"
                class="{{ request()->routeIs('barang.*') ? 'active' : '' }}"
                onclick="closeSidebarMobile()"
            >

                <i class="bi bi-box-seam"></i>

                <span>
                    Barang
                </span>

            </a>


            <!-- Tambah Stok -->

            <a
                href="{{ route('stok-masuk.tambah-stok') }}"
                class="{{ request()->routeIs('stok-masuk.*') ? 'active' : '' }}"
                onclick="closeSidebarMobile()"
            >

                <i class="bi bi-box-arrow-in-down"></i>

                <span>
                    Tambah Stok
                </span>

            </a>


            <!-- Riwayat Stok Masuk -->

            <a
                href="{{ route('admin.riwayat-stok-masuk') }}"
                class="{{ request()->routeIs('admin.riwayat-stok-masuk*') ? 'active' : '' }}"
                onclick="closeSidebarMobile()"
            >

                <i class="bi bi-clock-history"></i>

                <span>
                    Riwayat Stok Masuk
                </span>

            </a>


            <!-- Riwayat Stok Keluar -->

            <a
                href="{{ route('admin.riwayat-stok-keluar') }}"
                class="{{ request()->routeIs('admin.riwayat-stok-keluar*') ? 'active' : '' }}"
                onclick="closeSidebarMobile()"
            >

                <i class="bi bi-box-arrow-up"></i>

                <span>
                    Riwayat Stok Keluar
                </span>

            </a>


        @elseif(auth()->check() && auth()->user()->role === 'teknisi')


            <div class="menu-label">
                Menu Teknisi
            </div>


            <!-- Dashboard -->

            <a
                href="{{ route('teknisi.dashboard') }}"
                class="{{ request()->routeIs('teknisi.dashboard') ? 'active' : '' }}"
                onclick="closeSidebarMobile()"
            >

                <i class="bi bi-grid"></i>

                <span>
                    Dashboard
                </span>

            </a>


            <!-- Stok Keluar -->

            <a
                href="{{ route('stok-keluar.index') }}"
                class="{{ request()->routeIs('stok-keluar.*') ? 'active' : '' }}"
                onclick="closeSidebarMobile()"
            >

                <i class="bi bi-box-arrow-up"></i>

                <span>
                    Stok Keluar
                </span>

            </a>


            <!-- Riwayat -->

            <a
                href="{{ route('teknisi.riwayat') }}"
                class="{{ request()->routeIs('teknisi.riwayat') ? 'active' : '' }}"
                onclick="closeSidebarMobile()"
            >

                <i class="bi bi-clock-history"></i>

                <span>
                    Riwayat
                </span>

            </a>


        @endif


    </div>


    <!-- =====================================================
         LOGOUT
    ===================================================== -->

    <div class="sidebar-footer">

        @auth

            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >

                    <i class="bi bi-box-arrow-right"></i>

                    <span>
                        Logout
                    </span>

                </button>

            </form>

        @endauth

    </div>


</aside>


<!-- =========================================================
     MAIN CONTENT
========================================================= -->

<main class="main-content">


    <!-- =====================================================
         TOPBAR
    ===================================================== -->

    <header class="topbar">


        <div class="topbar-left">


            <!-- MOBILE MENU -->

            <button
                type="button"
                class="mobile-menu-button"
                onclick="openSidebar()"
                aria-label="Buka menu"
            >

                <i class="bi bi-list"></i>

            </button>


            <!-- PAGE TITLE -->

            <div class="page-heading">

                <h5>
                    @yield('page-title', 'Dashboard')
                </h5>

                <small>
                    Sistem Informasi Inventaris
                </small>

            </div>


        </div>


        <!-- USER -->

        @auth

            <div class="topbar-user">

                <div class="user-avatar">

                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                </div>

                <div class="user-info">

                    <div class="user-name">
                        {{ auth()->user()->name }}
                    </div>

                    <div class="user-role">
                        {{ auth()->user()->role }}
                    </div>

                </div>

            </div>

        @endauth


    </header>


    <!-- =====================================================
         PAGE CONTENT
    ===================================================== -->

    <div class="content-wrapper">

        @yield('content')

    </div>


</main>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>

    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');


    function openSidebar() {

        if (!sidebar) return;

        sidebar.classList.add('show');

        if (sidebarOverlay) {
            sidebarOverlay.classList.add('show');
        }

        document.body.style.overflow = 'hidden';
    }


    function closeSidebar() {

        if (!sidebar) return;

        sidebar.classList.remove('show');

        if (sidebarOverlay) {
            sidebarOverlay.classList.remove('show');
        }

        document.body.style.overflow = '';
    }


    function closeSidebarMobile() {

        if (window.innerWidth <= 991) {
            closeSidebar();
        }
    }


    /* ESC untuk menutup sidebar */

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {
            closeSidebar();
        }

    });


    /* Jika layar kembali ke desktop */

    window.addEventListener('resize', function() {

        if (window.innerWidth > 991) {
            closeSidebar();
        }

    });

</script>


@stack('scripts')

</body>
</html>