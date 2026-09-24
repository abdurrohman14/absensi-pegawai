<?php

namespace App\Models;

use App\Models\Absensi;
use App\Models\AttendanceLog;
use App\Models\Departemen;
use App\Models\Jadwal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pegawai extends Model
{
    protected $table = 'pegawais';

    protected $fillable = [
        'fingerprint_id',
        'nama',
    ];

    protected $casts = [
        'fingerprint_id' => 'integer',
    ];

    /**
     * Semua log fingerprint pegawai.
     */
    public function attendanceLogs(): HasMany
    {
        return $this->hasMany(
            AttendanceLog::class,
            'pegawai_id'
        );
    }

    /**
     * Rekap absensi pegawai.
     */
    public function absensis(): HasMany
    {
        return $this->hasMany(
            Absensi::class,
            'pegawai_id'
        );
    }
}
