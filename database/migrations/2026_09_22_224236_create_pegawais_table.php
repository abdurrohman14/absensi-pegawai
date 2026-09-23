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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departemen_id')
                ->constrained('departemens')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('jadwal_id')
                ->nullable()
                ->constrained('jadwals')
                ->nullOnDelete();

            $table->string('nip', 50)->unique();
            $table->string('nama');
            $table->string('jabatan')->nullable();

            // ID yang terdaftar pada mesin fingerprint.
            $table->unsignedInteger('fingerprint_id')->unique();

            $table->enum('status', ['aktif', 'nonaktif'])
                ->default('aktif');
            $table->timestamps();
            $table->index('nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
