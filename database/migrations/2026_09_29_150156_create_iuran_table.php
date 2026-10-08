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
        Schema::create('iuran', function (Blueprint $table) {
            $table->id();
            // MENGIKAT RELASI KE TABEL JAMAAH (Mengambil nama dari data jamaah)
            $table->foreignId('jamaah_id')->constrained('jamaahs')->onDelete('cascade');
            $table->date('tanggal_bayar');
            $table->string('bulan_iuran'); // Contoh: Januari, Februari
            $table->string('tahun_iuran'); // Contoh: 2026
            $table->integer('nominal');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iuran');
    }
};
