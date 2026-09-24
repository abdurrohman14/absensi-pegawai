<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-soft: #eff6ff;

            --text: #172033;
            --text-secondary: #475467;
            --muted: #8a94a6;

            --border: #e7ebf1;
            --background: #f7f9fc;
            --white: #ffffff;
        }

        /* =====================================================
       GENERAL
    ===================================================== */

        .attendance-page {
            min-height: calc(100vh - 70px);
            padding: 28px;
            background: var(--background);
        }

        /* =====================================================
       PAGE HEADER
    ===================================================== */

        .attendance-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 24px;

            margin-bottom: 26px;
        }

        .header-left {
            display: flex;
            align-items: center;

            gap: 16px;
        }

        .header-icon {
            width: 52px;
            height: 52px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background: var(--primary-soft);
            color: var(--primary);

            font-size: 22px;
        }

        .header-text {
            min-width: 0;
        }

        .page-title {
            margin: 0 0 7px 0;

            color: var(--text);

            font-size: 24px;
            font-weight: 700;

            line-height: 1.35;
        }

        .page-description {
            margin: 0;

            color: var(--muted);

            font-size: 13px;
            line-height: 1.7;
        }

        .system-status {
            display: inline-flex;
            align-items: center;

            gap: 10px;

            padding: 10px 15px;

            border: 1px solid var(--border);
            border-radius: 10px;

            background: var(--white);

            color: var(--text-secondary);

            font-size: 12px;
            font-weight: 600;

            white-space: nowrap;
        }

        .system-dot {
            width: 8px;
            height: 8px;

            border-radius: 50%;

            background: #f59e0b;
        }

        /* =====================================================
       STATISTICS
    ===================================================== */

        .statistics-row {
            margin-bottom: 24px;
        }

        .stat-card {
            height: 100%;

            padding: 21px;

            background: var(--white);

            border: 1px solid var(--border);
            border-radius: 15px;

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

            margin-bottom: 18px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background: var(--primary-soft);
            color: var(--primary);

            font-size: 18px;
        }

        .stat-menu {
            color: #b2bac6;

            font-size: 14px;
        }

        .stat-label {
            margin-bottom: 8px;

            color: var(--muted);

            font-size: 12px;
            line-height: 1.5;
        }

        .stat-number {
            color: var(--text);

            font-size: 25px;
            font-weight: 700;

            line-height: 1.2;
        }

        .stat-description {
            margin-top: 8px;

            color: #a2aaba;

            font-size: 10px;
            line-height: 1.6;
        }

        /* =====================================================
       MAIN CARD
    ===================================================== */

        .attendance-card {
            background: var(--white);

            border: 1px solid var(--border);
            border-radius: 17px;

            overflow: hidden;
        }

        /* =====================================================
   FILTER DATA
===================================================== */

        .filter-area {
            padding: 24px 26px 25px;

            background: #ffffff;

            border-bottom: 1px solid var(--border);
        }


        /* =====================================================
   FILTER HEADER
===================================================== */

        .filter-header {
            display: flex;
            align-items: center;

            gap: 13px;

            margin-bottom: 21px;
        }

        .filter-header-icon {
            width: 38px;
            height: 38px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: var(--primary-soft);
            color: var(--primary);

            font-size: 15px;
        }

        .filter-header-text {
            min-width: 0;
        }

        .filter-title {
            margin: 0 0 4px;

            color: var(--text);

            font-size: 13px;
            font-weight: 700;

            line-height: 1.5;
        }

        .filter-description {
            margin: 0;

            color: var(--muted);

            font-size: 10px;

            line-height: 1.6;
        }


        /* =====================================================
   FILTER FORM
===================================================== */

        .filter-form {
            width: 100%;
        }

        .filter-grid {
            display: grid;

            grid-template-columns:
                minmax(160px, 1fr) minmax(140px, .8fr) minmax(230px, 1.4fr) auto;

            align-items: end;

            gap: 15px;
        }


        /* =====================================================
   FILTER ITEM
===================================================== */

        .filter-item {
            min-width: 0;
        }

        .filter-label {
            display: block;

            margin: 0 0 8px;

            color: #596579;

            font-size: 11px;
            font-weight: 600;

            line-height: 1.5;
        }


        /* =====================================================
   INPUT WRAPPER
===================================================== */

        .filter-control-wrapper {
            position: relative;

            width: 100%;
        }


        /* =====================================================
   INPUT ICON
===================================================== */

        .filter-control-icon {
            position: absolute;

            top: 50%;
            left: 13px;

            z-index: 2;

            transform: translateY(-50%);

            color: #98a2b3;

            font-size: 13px;

            pointer-events: none;
        }


        /* =====================================================
   SELECT
===================================================== */

        .filter-input {
            width: 100%;
            height: 42px;

            padding: 0 38px 0 36px;

            border: 1px solid #dfe4eb;
            border-radius: 9px;

            background-color: #ffffff;

            color: #344054;

            font-size: 12px;
            font-weight: 500;

            line-height: 42px;

            outline: none;

            cursor: pointer;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background-color .2s ease;
        }

        .filter-input:hover {
            border-color: #cbd5e1;
        }

        .filter-input:focus {
            border-color: #8db4ff;

            background-color: #ffffff;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, .07);
        }


        /* =====================================================
   BUTTON AREA
===================================================== */

        .filter-buttons {
            display: flex;
            align-items: center;

            gap: 9px;

            height: 42px;
        }


        /* =====================================================
   SEARCH BUTTON
===================================================== */

        .btn-filter {
            height: 42px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            padding: 0 17px;

            border: 0;
            border-radius: 9px;

            background: var(--primary);
            color: #ffffff;

            font-size: 11px;
            font-weight: 600;

            white-space: nowrap;

            text-decoration: none;

            cursor: pointer;

            transition:
                background-color .2s ease,
                transform .15s ease,
                box-shadow .2s ease;
        }

        .btn-filter i {
            font-size: 12px;
        }

        .btn-filter:hover {
            background: var(--primary-dark);

            color: #ffffff;

            box-shadow:
                0 4px 12px rgba(37, 99, 235, .18);
        }

        .btn-filter:active {
            transform: translateY(1px);
        }


        /* =====================================================
   RESET BUTTON
===================================================== */

        .btn-filter-reset {
            width: 42px;
            height: 42px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid #dfe4eb;
            border-radius: 9px;

            background: #ffffff;
            color: #667085;

            text-decoration: none;

            transition:
                background-color .2s ease,
                border-color .2s ease,
                color .2s ease;
        }

        .btn-filter-reset i {
            font-size: 13px;
        }

        .btn-filter-reset:hover {
            background: var(--primary-soft);

            border-color: #cbdcff;

            color: var(--primary);
        }


        /* =====================================================
   LARGE SCREEN
===================================================== */

        @media (min-width: 1200px) {

            .filter-grid {
                grid-template-columns:
                    190px 150px minmax(260px, 1fr) auto;
            }

        }


        /* =====================================================
   TABLET
===================================================== */

        @media (max-width: 991px) {

            .filter-grid {

                grid-template-columns:
                    1fr 1fr;

                gap: 16px;

            }

            .filter-employee {
                grid-column: span 2;
            }

            .filter-buttons {
                grid-column: span 2;

                justify-content: flex-start;
            }

        }


        /* =====================================================
   MOBILE
===================================================== */

        @media (max-width: 576px) {

            .filter-area {
                padding: 20px 18px;
            }

            .filter-header {
                align-items: flex-start;

                gap: 11px;

                margin-bottom: 18px;
            }

            .filter-header-icon {
                width: 35px;
                height: 35px;
            }

            .filter-grid {
                display: flex;

                flex-direction: column;

                gap: 14px;
            }

            .filter-item {
                width: 100%;
            }

            .filter-buttons {
                width: 100%;

                margin-top: 3px;
            }

            .btn-filter {
                flex: 1;
            }

        }

        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            padding: 21px 24px;

            border-bottom: 1px solid var(--border);
        }

        .table-header-left {
            min-width: 0;
        }

        .table-title {
            margin: 0 0 6px 0;

            color: var(--text);

            font-size: 15px;
            font-weight: 700;

            line-height: 1.4;
        }

        .table-description {
            margin: 0;

            color: var(--muted);

            font-size: 11px;

            line-height: 1.7;
        }

        .table-actions {
            display: flex;
            align-items: center;

            gap: 9px;

            flex-shrink: 0;
        }

        .btn-export {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            min-width: 84px;
            height: 37px;

            padding: 0 13px;

            border: 1px solid #dfe4eb;
            border-radius: 9px;

            background: #fff;
            color: #596579;

            text-decoration: none;

            font-size: 11px;
            font-weight: 600;

            transition: .2s ease;
        }

        .btn-export:hover {
            background: var(--primary-soft);

            border-color: #cbdcff;

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

        .attendance-table thead th {
            padding: 14px 20px;

            background: #fafbfc;

            border-bottom: 1px solid var(--border);

            color: #7b8798;

            font-size: 10px;
            font-weight: 700;

            line-height: 1.5;

            text-transform: uppercase;
            letter-spacing: .4px;

            white-space: nowrap;
        }

        .attendance-table tbody td {
            padding: 16px 20px;

            border-bottom: 1px solid #f0f2f5;

            color: var(--text-secondary);

            font-size: 12px;

            line-height: 1.6;

            vertical-align: middle;

            white-space: nowrap;
        }

        .attendance-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .attendance-table tbody tr:hover {
            background: #fbfdff;
        }

        /* =====================================================
       NUMBER
    ===================================================== */

        .number-column {
            width: 60px;

            color: #a1aaba !important;

            font-size: 11px !important;

            text-align: center;
        }

        /* =====================================================
       EMPLOYEE
    ===================================================== */

        .employee-wrapper {
            display: flex;
            align-items: center;

            gap: 12px;
        }

        .employee-avatar {
            width: 38px;
            height: 38px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: var(--primary-soft);
            color: var(--primary);

            font-size: 12px;
            font-weight: 700;
        }

        .employee-information {
            min-width: 150px;
        }

        .employee-name {
            margin-bottom: 4px;

            color: #263247;

            font-size: 12px;
            font-weight: 600;

            line-height: 1.5;
        }

        .employee-id {
            color: #a0aaba;

            font-size: 9px;

            line-height: 1.5;
        }

        /* =====================================================
       DATE
    ===================================================== */

        .date-value {
            color: #475467;

            font-size: 12px;
            font-weight: 500;

            line-height: 1.6;
        }

        /* =====================================================
       TIME
    ===================================================== */

        .time-wrapper {
            display: inline-flex;
            align-items: center;

            gap: 8px;

            min-width: 82px;
        }

        .time-icon {
            color: var(--primary);

            font-size: 12px;
        }

        .time-text {
            color: #344054;

            font-size: 12px;
            font-weight: 600;

            line-height: 1.6;
        }

        .empty-time {
            color: #c1c8d2;

            font-size: 13px;
        }

        /* =====================================================
       EMPTY STATE
    ===================================================== */

        .empty-state {
            padding: 70px 25px;

            text-align: center;
        }

        .empty-icon {
            width: 60px;
            height: 60px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 16px;

            border-radius: 16px;

            background: #f1f5f9;

            color: #94a3b8;

            font-size: 23px;
        }

        .empty-title {
            margin-bottom: 7px;

            color: #344054;

            font-size: 14px;
            font-weight: 700;

            line-height: 1.5;
        }

        .empty-description {
            max-width: 350px;

            margin: 0 auto;

            color: #98a2b3;

            font-size: 11px;

            line-height: 1.8;
        }

        /* =====================================================
       FOOTER
    ===================================================== */

        .table-footer {
            padding: 13px 24px;

            background: #fafbfc;

            border-top: 1px solid var(--border);

            color: #98a2b3;

            font-size: 10px;

            line-height: 1.6;
        }

        /* =====================================================
       RESPONSIVE
    ===================================================== */

        @media (max-width: 992px) {

            .attendance-header {
                align-items: flex-start;

                flex-direction: column;
            }

            .system-status {
                width: 100%;

                justify-content: center;
            }
        }

        @media (max-width: 768px) {

            .attendance-page {
                padding: 18px;
            }

            .page-title {
                font-size: 21px;
            }

            .header-left {
                align-items: flex-start;
            }

            .filter-area {
                padding: 19px;
            }

            .table-header {
                align-items: flex-start;

                flex-direction: column;

                padding: 19px;
            }

            .table-actions {
                width: 100%;
            }

            .btn-export {
                flex: 1;
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

    @endphp


    <div class="attendance-page">

        {{-- =================================================
         HEADER
    ================================================== --}}

        <div class="attendance-header">

            <div class="header-left">

                <div class="header-icon">
                    <i class="bi bi-fingerprint"></i>
                </div>

                <div class="header-text">

                    <h1 class="page-title">
                        Rekap Absensi
                    </h1>

                    <p class="page-description">
                        Rekap data fingerprint pegawai berdasarkan periode yang dipilih.
                    </p>

                </div>

            </div>


            <div class="system-status">

                <span class="system-dot"></span>

                <span>
                    Sistem Absensi
                </span>

            </div>

        </div>


        {{-- =================================================
         STATISTICS
    ================================================== --}}

        <div class="row g-3 statistics-row">

            {{-- TOTAL --}}
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


            {{-- MASUK --}}
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


            {{-- ISTIRAHAT --}}
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


            {{-- PULANG --}}
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


        {{-- =================================================
         MAIN CARD
    ================================================== --}}

        <div class="attendance-card">


            {{-- =================================================
             FILTER
        ================================================== --}}

            {{-- =====================================================
     FILTER DATA
===================================================== --}}

            <div class="filter-area">

                <div class="filter-header">

                    <div class="filter-header-icon">
                        <i class="bi bi-funnel"></i>
                    </div>

                    <div class="filter-header-text">

                        <h6 class="filter-title">
                            Filter Data Absensi
                        </h6>

                        <p class="filter-description">
                            Pilih periode dan pegawai untuk menampilkan data absensi.
                        </p>

                    </div>

                </div>


                <form method="GET" action="{{ url()->current() }}" class="filter-form">

                    <div class="filter-grid">


                        {{-- =================================================
                 BULAN
            ================================================== --}}

                        <div class="filter-item">

                            <label for="bulan" class="filter-label">
                                Bulan
                            </label>

                            <div class="filter-control-wrapper">

                                <i class="bi bi-calendar3 filter-control-icon"></i>

                                <select id="bulan" name="bulan" class="filter-input">

                                    @foreach (range(1, 12) as $bulan)
                                        <option value="{{ $bulan }}"
                                            {{ (int) $bulanAktif === $bulan ? 'selected' : '' }}>

                                            {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}

                                        </option>
                                    @endforeach

                                </select>

                            </div>

                        </div>


                        {{-- =================================================
                 TAHUN
            ================================================== --}}

                        <div class="filter-item filter-year">

                            <label for="tahun" class="filter-label">
                                Tahun
                            </label>

                            <div class="filter-control-wrapper">

                                <i class="bi bi-calendar-event filter-control-icon"></i>

                                <select id="tahun" name="tahun" class="filter-input">

                                    @for ($tahun = now()->year - 2; $tahun <= now()->year + 1; $tahun++)
                                        <option value="{{ $tahun }}"
                                            {{ (int) $tahunAktif === $tahun ? 'selected' : '' }}>

                                            {{ $tahun }}

                                        </option>
                                    @endfor

                                </select>

                            </div>

                        </div>


                        {{-- =================================================
                 PEGAWAI
            ================================================== --}}

                        <div class="filter-item filter-employee">

                            <label for="pegawai_id" class="filter-label">
                                Pegawai
                            </label>

                            <div class="filter-control-wrapper">

                                <i class="bi bi-person filter-control-icon"></i>

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

                        </div>


                        {{-- =================================================
                 BUTTON
            ================================================== --}}

                        <div class="filter-buttons">

                            <button type="submit" class="btn-filter">

                                <i class="bi bi-search"></i>

                                <span>
                                    Tampilkan Data
                                </span>

                            </button>


                            <a href="{{ url()->current() }}" class="btn-filter-reset" title="Reset filter">

                                <i class="bi bi-arrow-counterclockwise"></i>

                            </a>

                        </div>

                    </div>

                </form>

            </div>


            {{-- =================================================
             TABLE HEADER
        ================================================== --}}

            <div class="table-header">

                <div class="table-header-left">

                    <h5 class="table-title">
                        Data Absensi Pegawai
                    </h5>

                    <p class="table-description">
                        Menampilkan {{ $totalData }} data absensi
                        pada periode yang dipilih.
                    </p>

                </div>


                <div class="table-actions">

                    <a href="#" class="btn-export">

                        <i class="bi bi-file-earmark-excel"></i>

                        <span>
                            Excel
                        </span>

                    </a>


                    <a href="#" class="btn-export">

                        <i class="bi bi-file-earmark-pdf"></i>

                        <span>
                            PDF
                        </span>

                    </a>

                </div>

            </div>


            {{-- =================================================
             TABLE
        ================================================== --}}

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


                                {{-- NO --}}

                                <td class="number-column">

                                    {{ $index + 1 }}

                                </td>


                                {{-- PEGAWAI --}}

                                <td>

                                    <div class="employee-wrapper">

                                        <div class="employee-avatar">

                                            {{ strtoupper(substr($absensi->pegawai->nama ?? 'P', 0, 1)) }}

                                        </div>


                                        <div class="employee-information">

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


                                {{-- TANGGAL --}}

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


                                {{-- JAM MASUK --}}

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


                                {{-- ISTIRAHAT --}}

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


                                {{-- JAM PULANG --}}

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


            {{-- =================================================
             FOOTER
        ================================================== --}}

            <div class="table-footer">

                <i class="bi bi-info-circle me-2"></i>

                Data absensi berasal dari pencatatan fingerprint pegawai.

            </div>

        </div>

    </div>

</body>

</html>
