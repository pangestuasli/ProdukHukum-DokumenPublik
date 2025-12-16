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
        Schema::create('dokumen_hukum', function (Blueprint $table) {
            $table->id('dokumen_id');
            $table->foreignId('jenis_id')->constrained('jenis_dokumen', 'jenis_id')->cascadeOnDelete();
            $table->foreignId('kategori_id')->constrained('kategori_dokumen', 'kategori_id')->cascadeOnDelete();
            $table->string('nomor')->unique();
            $table->string('judul');
            $table->date('tanggal');
            $table->text('ringkasan')->nullable();
            $table->string('status');
            $table->string('file_dokumen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_hukum');
    }
};
