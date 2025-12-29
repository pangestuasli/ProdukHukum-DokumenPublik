<?php
// database/migrations/2025_12_29_073629_create_lampiran_dokumen_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLampiranDokumenTable extends Migration
{
    public function up()
    {
        Schema::create('lampiran_dokumen', function (Blueprint $table) {
            $table->id('lampiran_id');
            $table->unsignedBigInteger('dokumen_id');
            $table->string('berkas_lampiran', 255);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Ubah referensi ke tabel dokumen_hukum
            $table->foreign('dokumen_id')
                  ->references('dokumen_id')
                  ->on('dokumen_hukum')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lampiran_dokumen');
    }
}