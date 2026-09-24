<?php

namespace App\Services;

use App\Models\Absensi;
use App\Models\AttendanceLog;
use App\Models\Pegawai;
use Illuminate\Support\Carbon;

class AttendanceProcessor
{
    /**
     * Memproses absensi satu pegawai untuk satu tanggal.
     */
    public function process(
        Pegawai $pegawai,
        string $tanggal
    ): ?Absensi {
        $jadwal = $pegawai->jadwal;

        if (!$jadwal) {
            return null;
        }

        $logs = AttendanceLog::query()
            ->where('pegawai_id', $pegawai->id)
            ->whereDate('tanggal', $tanggal)
            ->orderBy('jam')
            ->get();

        /*
         * Tidak ada fingerprint log.
         *
         * Kita tidak langsung membuat Alpha di sini karena
         * izin/sakit/cuti bisa saja dimasukkan secara manual.
         */
        if ($logs->isEmpty()) {
            return null;
        }

        $jamMasuk = $logs->first()->jam;
        $jamPulang = $logs->count() > 1
            ? $logs->last()->jam
            : null;

        /*
         * Tentukan status kehadiran.
         */
        $status = $this->determineStatus(
            $tanggal,
            $jamMasuk,
            $jadwal
        );

        return Absensi::updateOrCreate(
            [
                'pegawai_id' => $pegawai->id,
                'tanggal' => $tanggal,
            ],
            [
                'jam_masuk' => $jamMasuk,
                'jam_pulang' => $jamPulang,
                'status' => $status,
                'keterangan' => null,
            ]
        );
    }

    /**
     * Menentukan apakah pegawai hadir atau terlambat.
     */
    private function determineStatus(
        string $tanggal,
        string $jamMasuk,
        $jadwal
    ): string {
        $batasTerlambat = Carbon::parse(
            $tanggal . ' ' . $jadwal->jam_masuk
        )->addMinutes(
            $jadwal->toleransi_menit
        );

        $waktuMasuk = Carbon::parse(
            $tanggal . ' ' . $jamMasuk
        );

        return $waktuMasuk->gt($batasTerlambat)
            ? 'terlambat'
            : 'hadir';
    }
}
