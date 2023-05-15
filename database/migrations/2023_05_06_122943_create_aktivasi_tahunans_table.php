<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktivasi_tahunans', function (Blueprint $table) {
            $table->id();
            $table->string('id_aktivasi');
            $table->string('id_member');
            $table->string('nama_pegawai');
            $table->string('id_pegawai');
            $table->string('nama_member');
            $table->string('tanggal_aktivasi');
            $table->string('biaya_aktivasi');
            $table->string('masa_aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aktivasi_tahunans');
    }
};
