<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\AttendanceLog;
use App\Models\Pegawai;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Pegawai
        |--------------------------------------------------------------------------
        */

        $pegawaiData = [
            [
                'fingerprint_id' => 1,
                'nama' => 'Budi Santoso',
            ],
            [
                'fingerprint_id' => 2,
                'nama' => 'Ahmad Fauzi',
            ],
            [
                'fingerprint_id' => 3,
                'nama' => 'Citra Dewi',
            ],
            [
                'fingerprint_id' => 4,
                'nama' => 'Dina Lestari',
            ],
            [
                'fingerprint_id' => 5,
                'nama' => 'Eko Prasetyo',
            ],
            [
                'fingerprint_id' => 6,
                'nama' => 'Fajar Hidayat',
            ],
            [
                'fingerprint_id' => 7,
                'nama' => 'Gita Permata',
            ],
        ];

        $pegawais = collect($pegawaiData)->map(function ($data) {
            return Pegawai::create($data);
        });

        /*
        |--------------------------------------------------------------------------
        | Periode Data Dummy
        |--------------------------------------------------------------------------
        */

        $tanggalMulai = Carbon::create(2026, 9, 1);
        $tanggalAkhir = Carbon::create(2026, 9, 30);

        /*
        |--------------------------------------------------------------------------
        | Attendance Log
        |--------------------------------------------------------------------------
        |
        | Simulasi data mentah dari mesin fingerprint.
        |
        | Scan:
        | 1. Scan pertama  = masuk
        | 2. Scan kedua    = istirahat
        | 3. Scan ketiga   = pulang
        |
        */

        foreach ($pegawais as $pegawai) {

            for (
                $tanggal = $tanggalMulai->copy();
                $tanggal->lte($tanggalAkhir);
                $tanggal->addDay()
            ) {

                // Tidak membuat data untuk Sabtu dan Minggu
                if ($tanggal->isWeekend()) {
                    continue;
                }

                $hari = $tanggal->day;

                /*
                |--------------------------------------------------------------------------
                | Jam Scan
                |--------------------------------------------------------------------------
                */

                $jamMasuk = '07:00:00';
                $jamIstirahat = '12:30:00';
                $jamPulang = '15:30:00';

                /*
                |--------------------------------------------------------------------------
                | Variasi Jam Masuk
                |--------------------------------------------------------------------------
                */

                // Pegawai 1
                if (
                    $pegawai->fingerprint_id === 1 &&
                    in_array($hari, [5, 17])
                ) {
                    $jamMasuk = '07:18:00';
                }

                // Pegawai 2
                if (
                    $pegawai->fingerprint_id === 2 &&
                    $hari === 8
                ) {
                    $jamMasuk = '07:35:00';
                }

                // Pegawai 3
                if (
                    $pegawai->fingerprint_id === 3 &&
                    in_array($hari, [3, 12, 19])
                ) {
                    $jamMasuk = '07:25:00';
                }

                /*
                |--------------------------------------------------------------------------
                | Simpan Attendance Log
                |--------------------------------------------------------------------------
                */

                // Scan masuk
                AttendanceLog::create([
                    'pegawai_id' => $pegawai->id,
                    'tanggal' => $tanggal->toDateString(),
                    'jam' => $jamMasuk,
                    'sumber' => 'dummy',
                ]);

                // Scan istirahat
                AttendanceLog::create([
                    'pegawai_id' => $pegawai->id,
                    'tanggal' => $tanggal->toDateString(),
                    'jam' => $jamIstirahat,
                    'sumber' => 'dummy',
                ]);

                // Scan pulang
                AttendanceLog::create([
                    'pegawai_id' => $pegawai->id,
                    'tanggal' => $tanggal->toDateString(),
                    'jam' => $jamPulang,
                    'sumber' => 'dummy',
                ]);

                /*
                |--------------------------------------------------------------------------
                | Simpan Rekap Absensi
                |--------------------------------------------------------------------------
                */

                Absensi::create([
                    'pegawai_id' => $pegawai->id,
                    'tanggal' => $tanggal->toDateString(),
                    'jam_masuk' => $jamMasuk,
                    'jam_istirahat' => $jamIstirahat,
                    'jam_pulang' => $jamPulang,
                ]);
            }
        }
    }
}