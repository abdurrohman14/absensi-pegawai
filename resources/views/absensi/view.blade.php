<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Absensi</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">


    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --sidebar: #193984;
            --sidebar-dark: #132d6b;

            --background: #f5f7fb;
            --white: #ffffff;

            --text: #172033;
            --text-secondary: #475467;
            --muted: #8a94a6;

            --border: #e7ebf1;

            --sidebar-width: 250px;
        }


        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;

            min-height: 100vh;

            font-family: 'Poppins', sans-serif;

            background: var(--background);

            color: var(--text);
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {

            position: fixed;

            top: 0;
            left: 0;
            bottom: 0;

            width: var(--sidebar-width);

            background:
                linear-gradient(180deg,
                    var(--sidebar),
                    var(--sidebar-dark));

            z-index: 1000;

            display: flex;
            flex-direction: column;

            box-shadow:
                5px 0 20px rgba(0, 0, 0, .08);
        }


        .sidebar-brand {

            height: 75px;

            padding: 0 22px;

            display: flex;
            align-items: center;

            border-bottom:
                1px solid rgba(255, 255, 255, .10);
        }


        .brand-icon {

            width: 42px;
            height: 42px;

            border-radius: 11px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: rgba(255, 255, 255, .14);

            color: white;

            font-size: 20px;

            margin-right: 12px;
        }


        .brand-text {

            color: white;

            font-size: 15px;

            font-weight: 700;

            line-height: 1.3;
        }


        .brand-subtitle {

            display: block;

            margin-top: 2px;

            color: rgba(255, 255, 255, .60);

            font-size: 9px;

            font-weight: 400;
        }


        .sidebar-menu {

            padding: 25px 14px;

            flex: 1;
        }


        .menu-title {

            padding: 0 12px;

            margin-bottom: 10px;

            color: rgba(255, 255, 255, .45);

            font-size: 10px;

            font-weight: 600;

            text-transform: uppercase;

            letter-spacing: .8px;
        }


        .menu-link {

            display: flex;
            align-items: center;

            gap: 12px;

            width: 100%;

            padding: 12px 14px;

            margin-bottom: 5px;

            border-radius: 9px;

            color: rgba(255, 255, 255, .70);

            text-decoration: none;

            font-size: 12px;

            font-weight: 500;

            transition: .2s ease;
        }


        .menu-link i {

            width: 20px;

            text-align: center;

            font-size: 16px;
        }


        .menu-link:hover {

            background: rgba(255, 255, 255, .10);

            color: white;
        }


        .menu-link.active {

            background: rgba(255, 255, 255, .15);

            color: white;

            box-shadow:
                inset 3px 0 0 #60a5fa;
        }


        .sidebar-bottom {

            padding: 15px;

            border-top:
                1px solid rgba(255, 255, 255, .10);
        }


        .user-sidebar {

            display: flex;
            align-items: center;

            padding: 10px;

            margin-bottom: 10px;

            border-radius: 10px;

            background: rgba(255, 255, 255, .08);
        }


        .user-avatar {

            width: 36px;
            height: 36px;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #ffffff;

            color: var(--sidebar);

            font-size: 13px;

            font-weight: 700;

            flex-shrink: 0;
        }


        .user-information {

            min-width: 0;

            margin-left: 10px;
        }


        .user-name {

            color: white;

            font-size: 11px;

            font-weight: 600;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .user-role {

            margin-top: 2px;

            color: rgba(255, 255, 255, .55);

            font-size: 9px;
        }


        .btn-logout {

            width: 100%;

            border: 1px solid rgba(255, 255, 255, .15);

            border-radius: 8px;

            background: rgba(255, 255, 255, .07);

            color: rgba(255, 255, 255, .75);

            padding: 9px 12px;

            font-size: 11px;

            font-weight: 500;

            transition: .2s ease;
        }


        .btn-logout:hover {

            background: rgba(220, 38, 38, .18);

            border-color: rgba(255, 255, 255, .20);

            color: white;
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main-content {

            margin-left: var(--sidebar-width);

            min-height: 100vh;
        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {

            height: 75px;

            background: white;

            border-bottom: 1px solid var(--border);

            padding: 0 30px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            position: sticky;

            top: 0;

            z-index: 900;
        }


        .topbar-title {

            font-size: 15px;

            font-weight: 600;

            color: var(--text);
        }


        .topbar-subtitle {

            margin-top: 2px;

            color: var(--muted);

            font-size: 10px;
        }


        .topbar-right {

            display: flex;

            align-items: center;

            gap: 15px;
        }


        .system-status {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding: 8px 13px;

            border: 1px solid var(--border);

            border-radius: 9px;

            color: var(--text-secondary);

            background: #fff;

            font-size: 10px;

            font-weight: 600;
        }


        .system-dot {

            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: #22c55e;

            box-shadow:
                0 0 0 3px rgba(34, 197, 94, .12);
        }


        /* =====================================================
           PAGE
        ===================================================== */

        .attendance-page {

            padding: 28px;
        }


        .page-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 25px;
        }


        .page-header-left {

            display: flex;

            align-items: center;

            gap: 15px;
        }


        .header-icon {

            width: 50px;
            height: 50px;

            border-radius: 13px;

            display: flex;

            align-items: center;
            justify-content: center;

            background: #eff6ff;

            color: var(--primary);

            font-size: 21px;
        }


        .page-title {

            margin: 0 0 5px;

            font-size: 23px;

            font-weight: 700;

            color: var(--text);
        }


        .page-description {

            margin: 0;

            color: var(--muted);

            font-size: 11px;
        }


        /* =====================================================
           STATISTICS
        ===================================================== */

        .stat-card {

            height: 100%;

            padding: 20px;

            background: white;

            border: 1px solid var(--border);

            border-radius: 14px;

            transition: .2s ease;
        }


        .stat-card:hover {

            transform: translateY(-2px);

            box-shadow:
                0 8px 25px rgba(15, 23, 42, .06);
        }


        .stat-top {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 17px;
        }


        .stat-icon {

            width: 41px;
            height: 41px;

            border-radius: 11px;

            display: flex;

            align-items: center;
            justify-content: center;

            background: #eff6ff;

            color: var(--primary);

            font-size: 17px;
        }


        .stat-menu {

            color: #b2bac6;

            font-size: 14px;
        }


        .stat-label {

            margin-bottom: 7px;

            color: var(--muted);

            font-size: 11px;
        }


        .stat-number {

            color: var(--text);

            font-size: 24px;

            font-weight: 700;
        }


        .stat-description {

            margin-top: 7px;

            color: #a2aaba;

            font-size: 9px;
        }


        /* =====================================================
           MAIN CARD
        ===================================================== */

        .attendance-card {

            margin-top: 22px;

            background: white;

            border: 1px solid var(--border);

            border-radius: 15px;

            overflow: hidden;
        }


        /* =====================================================
           FILTER
        ===================================================== */

        .filter-area {

            padding: 23px 25px;

            border-bottom: 1px solid var(--border);
        }


        .filter-header {

            display: flex;

            align-items: center;

            gap: 12px;

            margin-bottom: 20px;
        }


        .filter-header-icon {

            width: 37px;
            height: 37px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background: #eff6ff;

            color: var(--primary);
        }


        .filter-title {

            margin: 0 0 3px;

            font-size: 13px;

            font-weight: 700;
        }


        .filter-description {

            margin: 0;

            color: var(--muted);

            font-size: 9px;
        }


        .filter-grid {

            display: grid;

            grid-template-columns:
                180px 140px minmax(220px, 1fr) auto;

            align-items: end;

            gap: 14px;
        }


        .filter-label {

            display: block;

            margin-bottom: 7px;

            color: #596579;

            font-size: 10px;

            font-weight: 600;
        }


        .filter-input {

            width: 100%;

            height: 41px;

            padding: 0 12px;

            border: 1px solid #dfe4eb;

            border-radius: 8px;

            background: white;

            color: #344054;

            font-size: 11px;

            outline: none;
        }


        .filter-input:focus {

            border-color: #8db4ff;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, .07);
        }


        .filter-buttons {

            display: flex;

            gap: 8px;
        }


        .btn-filter {

            height: 41px;

            padding: 0 16px;

            border: 0;

            border-radius: 8px;

            background: var(--primary);

            color: white;

            font-size: 10px;

            font-weight: 600;
        }


        .btn-filter:hover {

            background: var(--primary-dark);

            color: white;
        }


        .btn-reset {

            width: 41px;
            height: 41px;

            display: flex;

            align-items: center;
            justify-content: center;

            border: 1px solid #dfe4eb;

            border-radius: 8px;

            color: #667085;

            text-decoration: none;
        }


        .btn-reset:hover {

            background: #eff6ff;

            color: var(--primary);
        }


        /* =====================================================
           TABLE HEADER
        ===================================================== */

        .table-header {

            padding: 20px 24px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            border-bottom: 1px solid var(--border);
        }


        .table-title {

            margin: 0 0 4px;

            font-size: 14px;

            font-weight: 700;
        }


        .table-description {

            margin: 0;

            color: var(--muted);

            font-size: 10px;
        }


        .table-actions {

            display: flex;

            gap: 8px;
        }


        .btn-export {

            height: 35px;

            padding: 0 12px;

            display: inline-flex;

            align-items: center;

            gap: 7px;

            border: 1px solid #dfe4eb;

            border-radius: 8px;

            background: white;

            color: #596579;

            text-decoration: none;

            font-size: 10px;

            font-weight: 600;
        }


        .btn-export:hover {

            background: #eff6ff;

            color: var(--primary);
        }


        /* =====================================================
           TABLE
        ===================================================== */

        .table-container {

            width: 100%;

            overflow-x: auto;
        }


        .attendance-table {

            width: 100%;

            min-width: 850px;

            margin: 0;

            border-collapse: collapse;
        }


        .attendance-table th {

            padding: 13px 20px;

            background: #fafbfc;

            border-bottom: 1px solid var(--border);

            color: #7b8798;

            font-size: 9px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .3px;

            white-space: nowrap;
        }


        .attendance-table td {

            padding: 15px 20px;

            border-bottom: 1px solid #f0f2f5;

            color: var(--text-secondary);

            font-size: 11px;

            vertical-align: middle;

            white-space: nowrap;
        }


        .attendance-table tbody tr:hover {

            background: #fbfdff;
        }


        .number-column {

            width: 55px;

            text-align: center;

            color: #a1aaba !important;
        }


        /* =====================================================
           EMPLOYEE
        ===================================================== */

        .employee-wrapper {

            display: flex;

            align-items: center;

            gap: 10px;
        }


        .employee-avatar {

            width: 37px;
            height: 37px;

            border-radius: 10px;

            display: flex;

            align-items: center;
            justify-content: center;

            background: #eff6ff;

            color: var(--primary);

            font-size: 11px;

            font-weight: 700;
        }


        .employee-name {

            color: #263247;

            font-size: 11px;

            font-weight: 600;

            margin-bottom: 3px;
        }


        .employee-id {

            color: #a0aaba;

            font-size: 8px;
        }


        .date-value {

            color: #475467;

            font-size: 11px;

            font-weight: 500;
        }


        .time-wrapper {

            display: inline-flex;

            align-items: center;

            gap: 7px;
        }


        .time-icon {

            color: var(--primary);

            font-size: 12px;
        }


        .time-text {

            color: #344054;

            font-size: 11px;

            font-weight: 600;
        }


        .empty-time {

            color: #c1c8d2;

            font-size: 13px;
        }


        /* =====================================================
           EMPTY STATE
        ===================================================== */

        .empty-state {

            padding: 65px 25px;

            text-align: center;
        }


        .empty-icon {

            width: 60px;
            height: 60px;

            margin: 0 auto 15px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 15px;

            background: #f1f5f9;

            color: #94a3b8;

            font-size: 22px;
        }


        .empty-title {

            margin-bottom: 6px;

            color: #344054;

            font-size: 13px;

            font-weight: 700;
        }


        .empty-description {

            max-width: 350px;

            margin: 0 auto;

            color: #98a2b3;

            font-size: 10px;

            line-height: 1.8;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .table-footer {

            padding: 12px 24px;

            background: #fafbfc;

            border-top: 1px solid var(--border);

            color: #98a2b3;

            font-size: 9px;
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 991px) {

            .sidebar {

                width: 70px;
            }


            .sidebar-brand {

                justify-content: center;

                padding: 0;
            }


            .brand-icon {

                margin: 0;
            }


            .brand-text,
            .menu-title,
            .menu-link span,
            .user-information,
            .btn-logout span {

                display: none;
            }


            .menu-link {

                justify-content: center;

                padding: 12px;
            }


            .user-sidebar {

                justify-content: center;

                padding: 7px;
            }


            .main-content {

                margin-left: 70px;
            }


            .filter-grid {

                grid-template-columns: 1fr 1fr;
            }


            .filter-employee {

                grid-column: span 2;
            }


            .filter-buttons {

                grid-column: span 2;
            }
        }


        @media (max-width: 767px) {

            .topbar {

                padding: 0 18px;
            }


            .topbar-subtitle {

                display: none;
            }


            .system-status {

                display: none;
            }


            .attendance-page {

                padding: 18px;
            }


            .page-header {

                align-items: flex-start;

                flex-direction: column;
            }


            .filter-grid {

                display: flex;

                flex-direction: column;
            }


            .filter-item,
            .filter-buttons {

                width: 100%;
            }


            .filter-buttons {

                display: flex;
            }


            .btn-filter {

                flex: 1;
            }


            .table-header {

                align-items: flex-start;

                flex-direction: column;

                gap: 15px;
            }


            .table-actions {

                width: 100%;
            }


            .btn-export {

                flex: 1;

                justify-content: center;
            }
        }
    </style>

</head>


<body>


    @php

        $absensiData = $absensis ?? collect();

        $totalData = $absensiData->count();

        $totalMasuk = $absensiData->filter(fn($item) => !empty($item->jam_masuk))->count();

        $totalIstirahat = $absensiData->filter(fn($item) => !empty($item->jam_istirahat))->count();

        $totalPulang = $absensiData->filter(fn($item) => !empty($item->jam_pulang))->count();

        $bulanAktif = request('bulan', now()->month);

        $tahunAktif = request('tahun', now()->year);

        $user = auth()->user();

    @endphp


    <!-- =====================================================
     SIDEBAR
===================================================== -->

    <aside class="sidebar">


        <!-- BRAND -->

        <div class="sidebar-brand">

            <div class="brand-icon">

                <i class="bi bi-fingerprint"></i>

            </div>

            <div class="brand-text">

                Absensi

                <span class="brand-subtitle">
                    Sistem Absensi Karyawan
                </span>

            </div>

        </div>


        <!-- MENU -->

        <div class="sidebar-menu">

            <div class="menu-title">
                Menu Utama
            </div>


            <a href="{{ route('attendance.view') }}" class="menu-link active">

                <i class="bi bi-speedometer2"></i>

                <span>
                    Dashboard
                </span>

            </a>


            <a href="{{ route('attendance.view') }}" class="menu-link">

                <i class="bi bi-calendar-check"></i>

                <span>
                    Data Absensi
                </span>

            </a>


            <div class="menu-title mt-4">
                Sistem
            </div>


            <a href="{{ url('/attendance/view') }}" class="menu-link">

                <i class="bi bi-fingerprint"></i>

                <span>
                    Fingerprint
                </span>

            </a>

        </div>


        <!-- USER + LOGOUT -->

        <div class="sidebar-bottom">


            <div class="user-sidebar">

                <div class="user-avatar">

                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}

                </div>


                <div class="user-information">

                    <div class="user-name">

                        {{ $user->name ?? 'User' }}

                    </div>

                    <div class="user-role">

                        Administrator

                    </div>

                </div>

            </div>


            <!-- LOGOUT -->

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button type="submit" class="btn-logout">

                    <i class="bi bi-box-arrow-left me-2"></i>

                    <span>
                        Logout
                    </span>

                </button>

            </form>

        </div>

    </aside>


    <!-- =====================================================
     MAIN CONTENT
===================================================== -->

    <main class="main-content">


        <!-- =================================================
         TOPBAR
    ================================================== -->

        <header class="topbar">


            <div>

                <div class="topbar-title">

                    Dashboard Absensi

                </div>

                <div class="topbar-subtitle">

                    Monitoring dan rekap absensi karyawan

                </div>

            </div>


            <div class="topbar-right">

                <div class="system-status">

                    <span class="system-dot"></span>

                    Sistem Absensi Aktif

                </div>

            </div>

        </header>


        <!-- =================================================
         PAGE
    ================================================== -->

        <div class="attendance-page">


            <!-- HEADER -->

            <div class="page-header">


                <div class="page-header-left">

                    <div class="header-icon">

                        <i class="bi bi-fingerprint"></i>

                    </div>


                    <div>

                        <h1 class="page-title">

                            Rekap Absensi

                        </h1>


                        <p class="page-description">

                            Rekap data fingerprint pegawai berdasarkan periode yang dipilih.

                        </p>

                    </div>

                </div>

            </div>


            <!-- =================================================
             STATISTICS
        ================================================== -->

            <div class="row g-3">


                <!-- TOTAL -->

                <div class="col-6 col-xl-3">

                    <div class="stat-card">

                        <div class="stat-top">

                            <div class="stat-icon">

                                <i class="bi bi-calendar-check"></i>

                            </div>

                            <i class="bi bi-three-dots stat-menu"></i>

                        </div>


                        <div class="stat-label">

                            Total Rekap

                        </div>


                        <div class="stat-number">

                            {{ number_format($totalData) }}

                        </div>


                        <div class="stat-description">

                            Data pada periode yang dipilih

                        </div>

                    </div>

                </div>


                <!-- MASUK -->

                <div class="col-6 col-xl-3">

                    <div class="stat-card">

                        <div class="stat-top">

                            <div class="stat-icon">

                                <i class="bi bi-box-arrow-in-right"></i>

                            </div>

                            <i class="bi bi-check2 stat-menu"></i>

                        </div>


                        <div class="stat-label">

                            Jam Masuk

                        </div>


                        <div class="stat-number">

                            {{ number_format($totalMasuk) }}

                        </div>


                        <div class="stat-description">

                            Scan masuk yang tercatat

                        </div>

                    </div>

                </div>


                <!-- ISTIRAHAT -->

                <div class="col-6 col-xl-3">

                    <div class="stat-card">

                        <div class="stat-top">

                            <div class="stat-icon">

                                <i class="bi bi-cup-hot"></i>

                            </div>

                            <i class="bi bi-check2 stat-menu"></i>

                        </div>


                        <div class="stat-label">

                            Jam Istirahat

                        </div>


                        <div class="stat-number">

                            {{ number_format($totalIstirahat) }}

                        </div>


                        <div class="stat-description">

                            Scan istirahat yang tercatat

                        </div>

                    </div>

                </div>


                <!-- PULANG -->

                <div class="col-6 col-xl-3">

                    <div class="stat-card">

                        <div class="stat-top">

                            <div class="stat-icon">

                                <i class="bi bi-box-arrow-right"></i>

                            </div>

                            <i class="bi bi-check2 stat-menu"></i>

                        </div>


                        <div class="stat-label">

                            Jam Pulang

                        </div>


                        <div class="stat-number">

                            {{ number_format($totalPulang) }}

                        </div>


                        <div class="stat-description">

                            Scan pulang yang tercatat

                        </div>

                    </div>

                </div>

            </div>


            <!-- =================================================
             MAIN CARD
        ================================================== -->

            <div class="attendance-card">


                <!-- FILTER -->

                <div class="filter-area">


                    <div class="filter-header">

                        <div class="filter-header-icon">

                            <i class="bi bi-funnel"></i>

                        </div>


                        <div>

                            <h6 class="filter-title">

                                Filter Data Absensi

                            </h6>


                            <p class="filter-description">

                                Pilih periode dan pegawai untuk menampilkan data absensi.

                            </p>

                        </div>

                    </div>


                    <form method="GET" action="{{ url()->current() }}">

                        <div class="filter-grid">


                            <!-- BULAN -->

                            <div class="filter-item">

                                <label for="bulan" class="filter-label">

                                    Bulan

                                </label>


                                <select id="bulan" name="bulan" class="filter-input">

                                    @foreach (range(1, 12) as $bulan)
                                        <option value="{{ $bulan }}"
                                            {{ (int) $bulanAktif === $bulan ? 'selected' : '' }}>

                                            {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}

                                        </option>
                                    @endforeach

                                </select>

                            </div>


                            <!-- TAHUN -->

                            <div class="filter-item">

                                <label for="tahun" class="filter-label">

                                    Tahun

                                </label>


                                <select id="tahun" name="tahun" class="filter-input">

                                    @for ($tahun = now()->year - 2; $tahun <= now()->year + 1; $tahun++)
                                        <option value="{{ $tahun }}"
                                            {{ (int) $tahunAktif === $tahun ? 'selected' : '' }}>

                                            {{ $tahun }}

                                        </option>
                                    @endfor

                                </select>

                            </div>


                            <!-- PEGAWAI -->

                            <div class="filter-item">

                                <label for="pegawai_id" class="filter-label">

                                    Pegawai

                                </label>


                                <select id="pegawai_id" name="pegawai_id" class="filter-input">

                                    <option value="">

                                        Semua Pegawai

                                    </option>


                                    @foreach ($pegawais ?? collect() as $pegawai)
                                        <option value="{{ $pegawai->id }}"
                                            {{ (string) request('pegawai_id') === (string) $pegawai->id ? 'selected' : '' }}>

                                            {{ $pegawai->nama }}

                                        </option>
                                    @endforeach

                                </select>

                            </div>


                            <!-- BUTTON -->

                            <div class="filter-buttons">

                                <button type="submit" class="btn-filter">

                                    <i class="bi bi-search me-1"></i>

                                    Tampilkan

                                </button>


                                <a href="{{ url()->current() }}" class="btn-reset" title="Reset filter">

                                    <i class="bi bi-arrow-counterclockwise"></i>

                                </a>

                            </div>


                        </div>

                    </form>

                </div>


                <!-- =================================================
                 TABLE HEADER
            ================================================== -->

                <div class="table-header">


                    <div>

                        <h5 class="table-title">

                            Data Absensi Pegawai

                        </h5>


                        <p class="table-description">

                            Menampilkan
                            {{ $totalData }}
                            data absensi pada periode yang dipilih.

                        </p>

                    </div>


                    <div class="table-actions">

                        <a href="#" class="btn-export">

                            <i class="bi bi-file-earmark-excel"></i>

                            Excel

                        </a>


                        <a href="#" class="btn-export">

                            <i class="bi bi-file-earmark-pdf"></i>

                            PDF

                        </a>

                    </div>

                </div>


                <!-- =================================================
                 TABLE
            ================================================== -->

                <div class="table-container">

                    <table class="attendance-table">


                        <thead>

                            <tr>

                                <th class="number-column">
                                    No
                                </th>

                                <th>
                                    Pegawai
                                </th>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    Jam Masuk
                                </th>

                                <th>
                                    Istirahat
                                </th>

                                <th>
                                    Jam Pulang
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            @forelse($absensiData as $index => $absensi)
                                <tr>


                                    <!-- NO -->

                                    <td class="number-column">

                                        {{ $index + 1 }}

                                    </td>


                                    <!-- PEGAWAI -->

                                    <td>

                                        <div class="employee-wrapper">


                                            <div class="employee-avatar">

                                                {{ strtoupper(substr($absensi->pegawai->nama ?? 'P', 0, 1)) }}

                                            </div>


                                            <div>

                                                <div class="employee-name">

                                                    {{ $absensi->pegawai->nama ?? '-' }}

                                                </div>


                                                <div class="employee-id">

                                                    Fingerprint ID :
                                                    {{ $absensi->pegawai->fingerprint_id ?? '-' }}

                                                </div>

                                            </div>

                                        </div>

                                    </td>


                                    <!-- TANGGAL -->

                                    <td>

                                        @if ($absensi->tanggal)
                                            <span class="date-value">

                                                {{ \Carbon\Carbon::parse($absensi->tanggal)->translatedFormat('d M Y') }}

                                            </span>
                                        @else
                                            <span class="empty-time">
                                                —
                                            </span>
                                        @endif

                                    </td>


                                    <!-- MASUK -->

                                    <td>

                                        @if ($absensi->jam_masuk)
                                            <div class="time-wrapper">

                                                <i class="bi bi-box-arrow-in-right time-icon"></i>

                                                <span class="time-text">

                                                    {{ \Carbon\Carbon::parse($absensi->jam_masuk)->format('H:i') }}

                                                </span>

                                            </div>
                                        @else
                                            <span class="empty-time">
                                                —
                                            </span>
                                        @endif

                                    </td>


                                    <!-- ISTIRAHAT -->

                                    <td>

                                        @if ($absensi->jam_istirahat)
                                            <div class="time-wrapper">

                                                <i class="bi bi-cup-hot time-icon"></i>

                                                <span class="time-text">

                                                    {{ \Carbon\Carbon::parse($absensi->jam_istirahat)->format('H:i') }}

                                                </span>

                                            </div>
                                        @else
                                            <span class="empty-time">
                                                —
                                            </span>
                                        @endif

                                    </td>


                                    <!-- PULANG -->

                                    <td>

                                        @if ($absensi->jam_pulang)
                                            <div class="time-wrapper">

                                                <i class="bi bi-box-arrow-right time-icon"></i>

                                                <span class="time-text">

                                                    {{ \Carbon\Carbon::parse($absensi->jam_pulang)->format('H:i') }}

                                                </span>

                                            </div>
                                        @else
                                            <span class="empty-time">
                                                —
                                            </span>
                                        @endif

                                    </td>


                                </tr>


                            @empty


                                <tr>

                                    <td colspan="6">

                                        <div class="empty-state">

                                            <div class="empty-icon">

                                                <i class="bi bi-fingerprint"></i>

                                            </div>


                                            <div class="empty-title">

                                                Belum Ada Data Absensi

                                            </div>


                                            <p class="empty-description">

                                                Data fingerprint pegawai akan
                                                ditampilkan pada halaman ini
                                                setelah tersedia.

                                            </p>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse


                        </tbody>

                    </table>

                </div>


                <!-- FOOTER -->

                <div class="table-footer">

                    <i class="bi bi-info-circle me-2"></i>

                    Data absensi berasal dari pencatatan fingerprint pegawai.

                </div>


            </div>

        </div>

    </main>


    <!-- =====================================================
     BOOTSTRAP JS
===================================================== -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
