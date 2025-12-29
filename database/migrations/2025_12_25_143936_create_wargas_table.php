<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('wargas', function (Blueprint $table) {
            $table->id('warga_id');
            $table->string('no_ktp', 16)->unique();
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama', 20);
            $table->string('pekerjaan', 50);
            $table->string('telp', 15);
            $table->string('email', 100)->unique()->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wargas');
    }
};