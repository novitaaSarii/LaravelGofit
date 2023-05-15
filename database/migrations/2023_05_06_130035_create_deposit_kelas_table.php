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
        Schema::create('deposit_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('id_deposit_kelas');
            $table->string('id_member');
            $table->string('id_promo');
            $table->string('nama_member');
            $table->string('tanggal_deposit_kelas');
            $table->string('waktu_pembayaran');
            $table->string('nama_kelas');
            $table->string('total_deposit_kelas');
            $table->string('masa_berlaku');
            $table->string('id_pegawai');
            $table->string('nama_pegawai');
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
        Schema::dropIfExists('deposit_kelas');
    }
};
