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
        body {
            background: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 245px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #08213f;
            color: white;
            padding: 25px 15px;
        }

        .brand {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 35px;
        }

        .sidebar a {
            color: #dbe5f1;
            text-decoration: none;
            display: block;
            padding: 13px 15px;
            border-radius: 8px;
            margin-bottom: 7px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #1473e6;
            color: white;
        }

        .sidebar i {
            margin-right: 10px;
        }

        .main {
            margin-left: 245px;
            min-height: 100vh;
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
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0,0,0,.05);
        }

        .stat-card {
            padding: 22px;
        }

        .table th {
            background: #f1f5f9;
            white-space: nowrap;
        }

        .btn-primary {
            background: #1473e6;
            border-color: #1473e6;
        }

        .badge-stock {
            padding: 7px 12px;
            border-radius: 7px;
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="sidebar">

    <div class="brand">
        <i class="bi bi-box-seam"></i>
        INVENTARIS<br>
        PERALATAN
    </div>

    <a href="{{ route('dashboard') }}"
       class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid"></i> Dashboard
    </a>

    <a href="{{ route('stok-masuk.index') }}"
       class="{{ request()->routeIs('stok-masuk.*') ? 'active' : '' }}">
        <i class="bi bi-box-arrow-in-down"></i> Stok Masuk
    </a>

    <a href="{{ route('stok-keluar.index') }}"
       class="{{ request()->routeIs('stok-keluar.*') ? 'active' : '' }}">
        <i class="bi bi-box-arrow-up"></i> Stok Keluar
    </a>

    <a href="{{ route('barang.index') }}"
       class="{{ request()->routeIs('barang.*') ? 'active' : '' }}">
        <i class="bi bi-box"></i> Barang
    </a>

    <a href="{{ route('laporan.index') }}"
       class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">
        <i class="bi bi-file-earmark-text"></i> Laporan
    </a>

    <div style="position:absolute; bottom:25px; width:calc(100% - 30px);">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button class="btn btn-link text-white text-decoration-none w-100 text-start">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>

</div>

<div class="main">

    <div class="topbar">

        <div>
            <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
        </div>

        <div>
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

@stack('scripts')

</body>
</html>