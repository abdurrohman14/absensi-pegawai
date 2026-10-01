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

    {{-- Link Css --}}
    <link rel="stylesheet" href="{{asset('assets/css/dashboard.css')}}">

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

    @include('partials.admin.sidebar')


    <!-- =====================================================
     MAIN CONTENT
===================================================== -->

    <main class="main-content">


        <!-- =================================================
         TOPBAR
    ================================================== -->

        @include('partials.admin.navbar')


        <!-- =================================================
         PAGE
    ================================================== -->

        @yield('content')

    </main>


    <!-- =====================================================
     BOOTSTRAP JS
===================================================== -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
