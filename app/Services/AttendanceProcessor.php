<?php

namespace App\Services;

use App\Models\Absensi;
use App\Models\AttendanceLog;
use App\Models\Pegawai;

class AttendanceProcessor
{
    /**
     * Memproses absensi satu pegawai untuk satu tanggal.
     *
     * Pola scan:
     * 1 scan  = masuk
     * 2 scan  = masuk + pulang
     * 3 scan  = masuk + istirahat + pulang
     * >3 scan = scan pertama + scan kedua + scan terakhir
     */
    public function process(
        Pegawai $pegawai,
        string $tanggal
    ): ?Absensi {

        $logs = AttendanceLog::query()
            ->where('pegawai_id', $pegawai->id)
            ->whereDate('tanggal', $tanggal)
            ->orderBy('jam')
            ->get();

        /**
         * Tidak ada data fingerprint
         * untuk pegawai dan tanggal tersebut.
         */
        if ($logs->isEmpty()) {
            return null;
        }

        /*
         * Default.
         */
        $jamMasuk = null;
        $jamIstirahat = null;
        $jamPulang = null;

        /*
         * 1 scan:
         * dianggap sebagai jam masuk.
         */
        if ($logs->count() === 1) {

            $jamMasuk = $logs->first()->jam;
        }

        /*
         * 2 scan:
         * scan pertama = masuk
         * scan kedua   = pulang
         */
        elseif ($logs->count() === 2) {

            $jamMasuk = $logs->first()->jam;
            $jamPulang = $logs->last()->jam;
        }

        /*
         * 3 scan atau lebih:
         * scan pertama = masuk
         * scan kedua   = istirahat
         * scan terakhir = pulang
         */
        else {

            $jamMasuk = $logs->first()->jam;
            $jamIstirahat = $logs->get(1)->jam;
            $jamPulang = $logs->last()->jam;
        }

        /*
         * Simpan atau perbarui rekap absensi
         * berdasarkan pegawai dan tanggal.
         */
        return Absensi::updateOrCreate(
            [
                'pegawai_id' => $pegawai->id,
                'tanggal' => $tanggal,
            ],
            [
                'jam_masuk' => $jamMasuk,
                'jam_istirahat' => $jamIstirahat,
                'jam_pulang' => $jamPulang,
            ]
        );
    }
}