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
        Schema::create('warga_files', function (Blueprint $table) {
        $table->id();
        $table->foreignId('warga_id')->constrained('wargas', 'warga_id')->onDelete('cascade');
        $table->string('file');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warga_files');
    }
};
