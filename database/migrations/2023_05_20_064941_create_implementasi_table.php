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
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->string('pelaksana');
            $table->string('jumlah');
            $table->string('penerima_manfaat', 20);
            $table->string('rab', 20);
            $table->string('realisasi', 20);
            $table->integer('keterangan');
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
