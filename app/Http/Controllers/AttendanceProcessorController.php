<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pegawai;
use App\Services\AttendanceProcessor;
use Illuminate\Http\Request;

class AttendanceProcessorController extends Controller
{
    public function view(){
        $absensi = Absensi::all();
        $pegawai = Pegawai::all();

        return view(
            'absensi.view', compact('absensi', 'pegawai')
        );
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
