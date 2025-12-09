<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('jenis_dokumen', function (Blueprint $table) {
        $table->string('foto')->nullable()->after('deskripsi'); // kolom baru
    });
}

public function down()
{
    Schema::table('jenis_dokumen', function (Blueprint $table) {
        $table->dropColumn('foto');
    });
}

};
