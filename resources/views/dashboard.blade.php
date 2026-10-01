@extends('partials.admin.main')
@section('content')
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
@endsection
