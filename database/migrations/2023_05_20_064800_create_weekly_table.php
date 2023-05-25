<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeklyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_weekly', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_akundivisi')->constrained('tb_akundivisi')->onUpdate('cascade')->onDelete('cascade');
            $table->string('hr1');
            $table->string('hr2');
            $table->string('hr3');
            $table->string('hr4');
            $table->string('hr5');
            $table->string('rencana1');
            $table->string('rencana2');
            $table->string('rencana3');
            $table->string('rencana4');
            $table->string('rencana5');
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
        Schema::dropIfExists('tb_weekly');
    }
}
