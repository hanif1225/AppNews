<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade');
            $table->string('foto')->nullable();
            $table->text('alamat');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('instagram');
            $table->string('ktp')->nullable();
            $table->string('nama_rekening');
            $table->text('no_rekening');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('profil_user');
    }
}
