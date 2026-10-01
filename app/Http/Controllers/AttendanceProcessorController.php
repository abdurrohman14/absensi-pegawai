<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pegawai;
use App\Services\AttendanceProcessor;
use Illuminate\Http\Request;

class AttendanceProcessorController extends Controller
{
    public function view(Request $request)
    {
        // Filter bulan dan tahun
        $bulanAktif = (int) $request->get('bulan', now()->month);
        $tahunAktif = (int) $request->get('tahun', now()->year);

        // Query absensi berdasarkan periode
        $query = Absensi::with('pegawai')
            ->whereMonth('tanggal', $bulanAktif)
            ->whereYear('tanggal', $tahunAktif);

        // Filter pegawai jika dipilih
        if ($request->filled('pegawai_id')) {
            $query->where('pegawai_id', $request->pegawai_id);
        }

        // Ambil data absensi
        $absensiData = $query
            ->orderBy('tanggal', 'desc')
            ->get();

        // Data pegawai untuk dropdown
        $pegawais = Pegawai::orderBy('nama', 'asc')->get();

        // Statistik
        $totalData = $absensiData->count();

        $totalMasuk = $absensiData
            ->whereNotNull('jam_masuk')
            ->count();

        $totalIstirahat = $absensiData
            ->whereNotNull('jam_istirahat')
            ->count();

        $totalPulang = $absensiData
            ->whereNotNull('jam_pulang')
            ->count();

        return view('dashboard', compact(
            'absensiData',
            'pegawais',
            'bulanAktif',
            'tahunAktif',
            'totalData',
            'totalMasuk',
            'totalIstirahat',
            'totalPulang'
        ));
    }
    public function process(
        Request $request,
        AttendanceProcessor $processor
    ) {
        $request->validate([
            'pegawai_id' => ['required', 'exists:pegawais,id'],
            'tanggal' => ['required', 'date'],
        ]);

        $pegawai = Pegawai::findOrFail($request->pegawai_id);

        $absensi = $processor->process(
            $pegawai,
            $request->tanggal
        );

        if (!$absensi) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ditemukan attendance log.',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil diproses.',
            'data' => $absensi->load('pegawai'),
        ]);
    }
}
