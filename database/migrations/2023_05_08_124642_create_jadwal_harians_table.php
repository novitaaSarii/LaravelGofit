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
        Schema::create('jadwal_harians', function (Blueprint $table) {
            $table->id();
            $table->string('id_jadwal_harian');
            $table->string('id_pegawai');
            $table->string('id_kelas ');
            $table->string('tanggal');
            $table->string('hari_jadwal_harian');
            $table->string('waktu');
            $table->string('jenis_kelas');
            $table->string('keterangan_kelas');
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
        Schema::dropIfExists('jadwal_harians');
    }
};
