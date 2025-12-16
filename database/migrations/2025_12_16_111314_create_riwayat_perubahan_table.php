<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayat_perubahan', function (Blueprint $table) {
            $table->id('riwayat_id');
            $table->foreignId('dokumen_id')
                ->constrained('dokumen_hukum', 'dokumen_id')
                ->cascadeOnDelete();
            $table->date('tanggal');
            $table->text('uraian_perubahan');
            $table->string('versi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_perubahan');
    }
};
