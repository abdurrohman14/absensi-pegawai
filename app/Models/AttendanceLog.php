<?php

namespace App\Models;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttendanceLog extends Model
{
     protected $table = 'attendance_logs';

    protected $fillable = [
        'pegawai_id',
        'tanggal',
        'jam',
        'sumber',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Pegawai pemilik log.
     */
    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(
            Pegawai::class,
            'pegawai_id'
        );
    }
}
