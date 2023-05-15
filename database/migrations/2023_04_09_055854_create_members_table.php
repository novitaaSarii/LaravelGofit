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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->id_member();
            $table->nama_member();
            $table->alamat_member();
            $table->telepon_member();
            $table->email_member();
            $table->lahir_member();
            $table->password_member();
            $table->jumlah_deposit_kelas();
            $table->jumlah_deposit_reguler();
            $table->masa_kadaluarsa_member();
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
        Schema::dropIfExists('members');
    }
};
