<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')
                ->constrained('pegawais')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->date('tanggal');

            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();

            $table->enum('status', [
                'hadir',
                'terlambat',
                'izin',
                'sakit',
                'cuti',
                'alpha'
            ]);

            $table->text('keterangan')->nullable();

            $table->timestamps();

            // Satu pegawai hanya memiliki satu rekap absensi per hari.
            $table->unique([
                'pegawai_id',
                'tanggal'
            ]);

            $table->index('tanggal');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
