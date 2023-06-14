<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkundivisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_akundivisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_divisi')->constrained('tb_divisi')->onUpdate('cascade')->onDelete('cascade');
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->foreignId('id_level')->constrained('tb_level')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('last_login_at')->nullable();
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
        Schema::dropIfExists('tb_akundivisi');
    }
}
