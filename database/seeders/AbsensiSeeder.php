<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\AttendanceLog;
use App\Models\Departemen;
use App\Models\Jadwal;
use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        | Departemen
        |--------------------------------------------------------------------------
        */

        $it = Departemen::create([
            'nama_departemen' => 'Teknologi Informasi',
            'kode' => 'TI',
            'status' => true,
        ]);

        $hr = Departemen::create([
            'nama_departemen' => 'Human Resources',
            'kode' => 'HR',
            'status' => true,
        ]);

        $keuangan = Departemen::create([
            'nama_departemen' => 'Keuangan',
            'kode' => 'KEU',
            'status' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Jadwal
        |--------------------------------------------------------------------------
        */

        $jadwalNormal = Jadwal::create([
            'nama_jadwal' => 'Jam Kerja Normal',
            'jam_masuk' => '07:00:00',
            'jam_pulang' => '15:30:00',
            'toleransi_menit' => 15,
            'status' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Pegawai
        |--------------------------------------------------------------------------
        */

        $pegawai = [
            [
                'departemen_id' => $it->id,
                'nip' => 'PEG001',
                'nama' => 'Budi Santoso',
                'jabatan' => 'Staff IT',
                'fingerprint_id' => 1,
            ],
            [
                'departemen_id' => $it->id,
                'nip' => 'PEG002',
                'nama' => 'Ahmad Fauzi',
                'jabatan' => 'Web Developer',
                'fingerprint_id' => 2,
            ],
            [
                'departemen_id' => $it->id,
                'nip' => 'PEG003',
                'nama' => 'Citra Dewi',
                'jabatan' => 'System Administrator',
                'fingerprint_id' => 3,
            ],
            [
                'departemen_id' => $hr->id,
                'nip' => 'PEG004',
                'nama' => 'Dina Lestari',
                'jabatan' => 'Staff HR',
                'fingerprint_id' => 4,
            ],
            [
                'departemen_id' => $hr->id,
                'nip' => 'PEG005',
                'nama' => 'Eko Prasetyo',
                'jabatan' => 'HR Officer',
                'fingerprint_id' => 5,
            ],
            [
                'departemen_id' => $keuangan->id,
                'nip' => 'PEG006',
                'nama' => 'Fajar Hidayat',
                'jabatan' => 'Staff Keuangan',
                'fingerprint_id' => 6,
            ],
            [
                'departemen_id' => $keuangan->id,
                'nip' => 'PEG007',
                'nama' => 'Gita Permata',
                'jabatan' => 'Accounting',
                'fingerprint_id' => 7,
            ],
        ];

        $pegawais = collect($pegawai)->map(function ($data) use ($jadwalNormal) {
            return Pegawai::create([
                ...$data,
                'jadwal_id' => $jadwalNormal->id,
                'status' => 'aktif',
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | Attendance Log Dummy
        |--------------------------------------------------------------------------
        */

        $tanggalMulai = Carbon::create(2026, 9, 1);
        $tanggalAkhir = Carbon::create(2026, 9, 30);

        foreach ($pegawais as $pegawai) {
            for (
                $tanggal = $tanggalMulai->copy();
                $tanggal->lte($tanggalAkhir);
                $tanggal->addDay()
            ) {
                // Sabtu dan Minggu tidak dibuatkan absensi.
                if ($tanggal->isWeekend()) {
                    continue;
                }

                /*
                 * Beberapa variasi data dummy.
                 */

                $hari = $tanggal->day;

                // Contoh izin tanggal tertentu.
                if ($pegawai->fingerprint_id === 4 && $hari === 10) {
                    Absensi::create([
                        'pegawai_id' => $pegawai->id,
                        'tanggal' => $tanggal->toDateString(),
                        'status' => 'izin',
                        'keterangan' => 'Izin keperluan keluarga',
                    ]);

                    continue;
                }

                // Contoh sakit.
                if ($pegawai->fingerprint_id === 5 && $hari === 15) {
                    Absensi::create([
                        'pegawai_id' => $pegawai->id,
                        'tanggal' => $tanggal->toDateString(),
                        'status' => 'sakit',
                        'keterangan' => 'Sakit',
                    ]);

                    continue;
                }

                // Contoh alpha.
                if ($pegawai->fingerprint_id === 7 && $hari === 20) {
                    Absensi::create([
                        'pegawai_id' => $pegawai->id,
                        'tanggal' => $tanggal->toDateString(),
                        'status' => 'alpha',
                        'keterangan' => 'Tidak ada data kehadiran',
                    ]);

                    continue;
                }

                /*
                 * Tentukan jam masuk.
                 *
                 * Beberapa pegawai dibuat terlambat
                 * untuk menguji sistem rekap.
                 */

                $jamMasuk = '07:00:00';

                if (
                    $pegawai->fingerprint_id === 3 &&
                    in_array($hari, [3, 12, 19])
                ) {
                    $jamMasuk = '07:25:00';
                }

                if (
                    $pegawai->fingerprint_id === 1 &&
                    in_array($hari, [5, 17])
                ) {
                    $jamMasuk = '07:18:00';
                }

                if (
                    $pegawai->fingerprint_id === 2 &&
                    $hari === 8
                ) {
                    $jamMasuk = '07:35:00';
                }

                $jamPulang = '15:30:00';

                // Log masuk.
                AttendanceLog::create([
                    'pegawai_id' => $pegawai->id,
                    'tanggal' => $tanggal->toDateString(),
                    'jam' => $jamMasuk,
                    'sumber' => 'dummy',
                ]);

                // Log pulang.
                AttendanceLog::create([
                    'pegawai_id' => $pegawai->id,
                    'tanggal' => $tanggal->toDateString(),
                    'jam' => $jamPulang,
                    'sumber' => 'dummy',
                ]);

                /*
                 * Untuk sementara kita juga membuat
                 * hasil absensi hariannya.
                 *
                 * Nanti bagian ini akan dipindahkan
                 * ke service khusus pengolah absensi.
                 */

                $batasTerlambat = Carbon::parse(
                    $tanggal->format('Y-m-d') . ' 07:00:00'
                )->addMinutes(
                    $jadwalNormal->toleransi_menit
                );

                $waktuMasuk = Carbon::parse(
                    $tanggal->format('Y-m-d') . ' ' . $jamMasuk
                );

                $status = $waktuMasuk->gt($batasTerlambat)
                    ? 'terlambat'
                    : 'hadir';

                Absensi::create([
                    'pegawai_id' => $pegawai->id,
                    'tanggal' => $tanggal->toDateString(),
                    'jam_masuk' => $jamMasuk,
                    'jam_pulang' => $jamPulang,
                    'status' => $status,
                ]);
            }
        }
    }
}
