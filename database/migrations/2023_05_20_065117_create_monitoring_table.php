<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_monitoring', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('tb_user')->onUpdate('cascade')->onDelete('cascade');
            $table->string('program');
            $table->integer('keterangan');
            $table->text('output');
            $table->text('outcome');
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
        Schema::dropIfExists('tb_monitoring');
    }
}
