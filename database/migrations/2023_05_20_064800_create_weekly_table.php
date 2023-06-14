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
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->text('rencana');
            $table->integer('status')->default(0);
            $table->integer('progres')->default(0);
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
