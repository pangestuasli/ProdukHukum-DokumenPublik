<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_perubahan', function (Blueprint $table) {
            $table->id('riwayat_id');
            $table->unsignedBigInteger('dokumen_id');
            $table->date('tanggal');
            $table->text('uraian_perubahan');
            $table->integer('versi')->default(1);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('dokumen_id')
                  ->references('dokumen_id')
                  ->on('dokumen_hukum')
                  ->onDelete('cascade');

            // Indexes
            $table->index('dokumen_id');
            $table->index('tanggal');
            $table->index('versi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_perubahan');
    }
};