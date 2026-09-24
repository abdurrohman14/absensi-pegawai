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
        | Simpan payload untuk sementara di log
        |--------------------------------------------------------------------------
        | Ini sangat berguna saat pertama kali menghubungkan Fingerspot.
        | Kita bisa melihat format data asli yang dikirim oleh Fingerspot
        | sebelum menentukan field finalnya.
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
        | Untuk tahap awal:
        |
        | Kita belum mengunci nama field dari Fingerspot.
        | Karena payload resmi webhook harus kita sesuaikan setelah
        | melihat konfigurasi Developer Fingerspot.
        |
        | Sementara kita coba beberapa nama field yang umum digunakan.
        |--------------------------------------------------------------------------
        */

        $fingerprintId =
            $data['fingerprint_id']
            ?? $data['fingerprintId']
            ?? $data['user_id']
            ?? $data['userId']
            ?? $data['pin']
            ?? $data['id'];

        $tanggal =
            $data['tanggal']
            ?? $data['date']
            ?? $data['attendance_date'];

        $jam =
            $data['jam']
            ?? $data['time']
            ?? $data['attendance_time'];

        /*
        |--------------------------------------------------------------------------
        | Validasi data minimum
        |--------------------------------------------------------------------------
        */

        if (!$fingerprintId || !$tanggal || !$jam) {
            return response()->json([
                'success' => false,
                'message' => 'Data webhook belum lengkap.',
                'received' => $data,
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Cari pegawai berdasarkan fingerprint ID
        |--------------------------------------------------------------------------
        */

        $pegawai = Pegawai::where(
            'fingerprint_id',
            $fingerprintId
        )->first();

        if (!$pegawai) {
            Log::warning('FINGERSPOT UNKNOWN FINGERPRINT ID', [
                'fingerprint_id' => $fingerprintId,
                'payload' => $data,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Fingerprint ID belum terdaftar sebagai pegawai.',
                'fingerprint_id' => $fingerprintId,
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | Normalisasi tanggal dan jam
        |--------------------------------------------------------------------------
        */

        try {
            $tanggalNormal = Carbon::parse($tanggal)
                ->format('Y-m-d');

            $jamNormal = Carbon::parse($jam)
                ->format('H:i:s');
        } catch (\Throwable $e) {

            Log::error('FINGERSPOT INVALID DATE/TIME', [
                'tanggal' => $tanggal,
                'jam' => $jam,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Format tanggal atau jam tidak valid.',
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Simpan attendance log
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
            'message' => 'Data absensi berhasil diterima.',
            'data' => [
                'fingerprint_id' => $pegawai->fingerprint_id,
                'nama' => $pegawai->nama,
                'tanggal' => $tanggalNormal,
                'jam' => $jamNormal,
                'attendance_log_id' => $attendanceLog->id,
                'absensi_id' => $absensi?->id,
            ],
        ]);
    }
}