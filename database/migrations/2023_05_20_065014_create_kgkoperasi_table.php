<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKgkoperasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kgkoperasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('tb_user')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kegiatan');
            $table->string('tgl_pelaksanaan1', 2);
            $table->string('tgl_pelaksanaan2', 2)->nullable();
            $table->string('bulan_pelaksanaan');
            $table->string('tahun_pelaksanaan', 4);
            $table->string('pelaksana');
            $table->string('jmlh', 4);
            $table->string('keterangan');
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
        Schema::dropIfExists('tb_kgkoperasi');
    }
}
