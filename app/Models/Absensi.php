<?php

namespace App\Models;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absensi extends Model
{
    protected $table = 'absensis';

    protected $fillable = [
        'pegawai_id',
        'tanggal',
        'jam_masuk',
        'jam_istirahat',
        'jam_pulang',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Pegawai pemilik absensi.
     */
    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(
            Pegawai::class,
            'pegawai_id'
        );
    }

}
