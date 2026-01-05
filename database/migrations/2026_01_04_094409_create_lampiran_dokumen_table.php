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
        Schema::create('lampiran_dokumen', function (Blueprint $table) {
            $table->id('lampiran_id');
            $table->unsignedBigInteger('dokumen_id');
            $table->string('keterangan');
            $table->string('media');
            $table->timestamps();

            $table->foreign('dokumen_id')->references('dokumen_id')->on('dokumen_hukum')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lampiran_dokumen');
    }
};
