<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use App\Models\Pegawai;
use App\Services\AttendanceProcessor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FingerprintWebhookController extends Controller
{
    public function handle(
        Request $request,
        AttendanceProcessor $processor
    ) {
        /*
        |--------------------------------------------------------------------------
        | Simpan payload asli ke log Laravel
        |--------------------------------------------------------------------------
        */

        Log::info('FINGERSPOT WEBHOOK RECEIVED', [
            'headers' => $request->headers->all(),
            'payload' => $request->all(),
            'raw_body' => $request->getContent(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Ambil payload
        |--------------------------------------------------------------------------
        */

        $data = $request->all();

        /*
        |--------------------------------------------------------------------------
        | Pastikan event adalah attlog
        |--------------------------------------------------------------------------
        */

        if (($data['type'] ?? null) !== 'attlog') {
            return response()->json([
                'success' => false,
                'message' => 'Event bukan attlog.',
            ], 400);
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil cloud ID
        |--------------------------------------------------------------------------
        */

        $cloudId = $data['cloud_id'] ?? null;

        /*
        |--------------------------------------------------------------------------
        | Ambil data attendance dari Fingerspot
        |--------------------------------------------------------------------------
        */

        $fingerprintId = data_get($data, 'data.pin');
        $scan = data_get($data, 'data.scan');
        $verify = data_get($data, 'data.verify');
        $statusScan = data_get($data, 'data.status_scan');

        /*
        |--------------------------------------------------------------------------
        | Validasi payload
        |--------------------------------------------------------------------------
        */

        if (!$cloudId || !$fingerprintId || !$scan) {

            Log::warning('FINGERSPOT WEBHOOK DATA TIDAK LENGKAP', [
                'payload' => $data,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Data webhook tidak lengkap.',
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Cari pegawai berdasarkan fingerprint ID / PIN
        |--------------------------------------------------------------------------
        */

        $pegawai = Pegawai::where(
            'fingerprint_id',
            $fingerprintId
        )->first();

        if (!$pegawai) {

            Log::warning('FINGERSPOT UNKNOWN FINGERPRINT ID', [
                'fingerprint_id' => $fingerprintId,
                'cloud_id' => $cloudId,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Fingerprint ID belum terdaftar sebagai pegawai.',
                'fingerprint_id' => $fingerprintId,
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | Pisahkan tanggal dan jam dari field scan
        |--------------------------------------------------------------------------
        |
        | Contoh:
        | 2026-10-01 07:15
        |
        */

        try {

            $scanDateTime = Carbon::parse($scan);

            $tanggalNormal = $scanDateTime->format('Y-m-d');

            $jamNormal = $scanDateTime->format('H:i:s');

        } catch (\Throwable $e) {

            Log::error('FINGERSPOT INVALID SCAN TIME', [
                'scan' => $scan,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Format waktu scan tidak valid.',
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Simpan raw attendance log
        |--------------------------------------------------------------------------
        */

        $attendanceLog = AttendanceLog::firstOrCreate(
            [
                'pegawai_id' => $pegawai->id,
                'tanggal' => $tanggalNormal,
                'jam' => $jamNormal,
                'sumber' => 'fingerprint',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Proses menjadi absensi harian
        |--------------------------------------------------------------------------
        */

        $absensi = $processor->process(
            $pegawai,
            $tanggalNormal
        );

        /*
        |--------------------------------------------------------------------------
        | Response
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,
            'message' => 'Realtime attendance berhasil diterima.',
            'data' => [
                'cloud_id' => $cloudId,
                'fingerprint_id' => $pegawai->fingerprint_id,
                'nama' => $pegawai->nama,
                'tanggal' => $tanggalNormal,
                'jam' => $jamNormal,
                'verify' => $verify,
                'status_scan' => $statusScan,
                'attendance_log_id' => $attendanceLog->id,
                'absensi_id' => $absensi?->id,
            ],
        ]);
    }
}