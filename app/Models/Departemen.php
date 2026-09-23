<?php

namespace App\Models;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departemen extends Model
{
     protected $fillable = [
        'nama_departemen',
        'kode',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function pegawais(): HasMany
    {
        return $this->hasMany(Pegawai::class);
    }
}
