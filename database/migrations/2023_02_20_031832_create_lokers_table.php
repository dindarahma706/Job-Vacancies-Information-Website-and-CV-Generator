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
        Schema::create('lokers', function (Blueprint $table) {
            $table->id();
            $table->string('judul_loker');
            $table->foreign('id_pekerjaan')->references('id')->on('pekerjaans');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->foreign('id_perusahaan')->references('id')->on('perusahaans');
            $table->text('deskripsi');
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
        Schema::dropIfExists('lokers');
    }
};
