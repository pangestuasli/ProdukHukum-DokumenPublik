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
        Schema::create('dokumen_hukum', function (Blueprint $table) {
            $table->id('dokumen_id');
            
            // Foreign keys
            $table->unsignedBigInteger('jenis_id');
            $table->unsignedBigInteger('kategori_id');
            
            // Kolom utama
            $table->string('nomor', 100);
            $table->string('judul', 255);
            $table->date('tanggal');
            $table->text('ringkasan')->nullable();
            $table->enum('status', ['draft', 'publik', 'arsip'])->default('draft');
            
            // Timestamps
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('jenis_id')->references('jenis_id')->on('jenis_dokumen')->onDelete('restrict');
            $table->foreign('kategori_id')->references('kategori_id')->on('kategori_dokumen')->onDelete('restrict');
            
            // Indexes
            $table->index('jenis_id');
            $table->index('kategori_id');
            $table->index('status');
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