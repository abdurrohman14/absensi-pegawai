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
        Schema::create('attendance_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')
                ->constrained('pegawais')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->date('tanggal');
            $table->time('jam');

            // Untuk sementara dummy.
            // Nanti nilainya bisa: fingerprint, import, manual.
            $table->string('sumber')->default('dummy');

            $table->index(['pegawai_id', 'tanggal']);
            $table->index('tanggal');

            // Mencegah satu transaksi fingerprint masuk dua kali.
            $table->unique([
                'pegawai_id',
                'tanggal',
                'jam',
                'sumber'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_logs');
    }
};
