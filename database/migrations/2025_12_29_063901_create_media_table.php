<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');
            $table->string('ref_table'); // 'dokumen_hukum'
            $table->unsignedBigInteger('ref_id'); // dokumen_id
            $table->string('file_url');
            $table->string('caption')->nullable();
            $table->string('mime_type');
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['ref_table', 'ref_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};