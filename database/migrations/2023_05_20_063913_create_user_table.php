<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_user', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nm_depan', 50);
            $table->string('nm_belakang', 50)->nullable();
            $table->string('jk', 20);
            $table->string('tmp_lahir', 50);
            $table->string('tgl_lahir');
            $table->string('nohp', 15);
            $table->string('email', 100)->unique();
            $table->text('alamat');
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
        Schema::dropIfExists('tb_user');
    }
}
