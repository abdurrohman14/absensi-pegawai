<?php

namespace App\Models;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jadwal extends Model
{
    // protected $fillable = [
    //     'nama_jadwal',
    //     'jam_masuk',
    //     'jam_pulang',
    //     'toleransi_menit',
    //     'status',
    // ];

    // protected $casts = [
    //     'status' => 'boolean',
    // ];

    // public function pegawais(): HasMany
    // {
    //     return $this->hasMany(Pegawai::class);
    // }
}
