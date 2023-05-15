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
        Schema::create('jadwal_umums', function (Blueprint $table) {
            $table->id();
            
            $table->string('id_kelas');
            $table->string('id_instruktur');
            $table->string('hari_jadwal_umum');
            $table->string('waktu');
            $table->string('jenis_kelas');
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
        Schema::dropIfExists('jadwal_umums');
    }
};
