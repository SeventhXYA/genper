<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailysdTable extends Migration
{

    public function up()
    {
        Schema::create('tb_dailysd', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('tb_user')->onUpdate('cascade')->onDelete('cascade');
            $table->string('tgl_sd');
            $table->string('wkt_mulai');
            $table->string('wkt_selesai');
            $table->text('rencana');
            $table->text('aktual');
            $table->integer('progres');
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('tb_dailysd');
    }
}
