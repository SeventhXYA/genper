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
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('pelaksana');
            $table->integer('jumlah');
            $table->text('keterangan');
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
