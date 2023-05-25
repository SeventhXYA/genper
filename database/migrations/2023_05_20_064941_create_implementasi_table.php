<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImplementasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_implementasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('tb_user')->onUpdate('cascade')->onDelete('cascade');
            $table->string('program');
            $table->string('tgl_pelaksanaan');
            $table->string('pelaksana');
            $table->string('jmlh', 4);
            $table->string('penerima_manfaat', 20);
            $table->string('rab', 20);
            $table->string('realisasi', 20);
            $table->string('keterangan', 20);
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
        Schema::dropIfExists('tb_implementasi');
    }
}
