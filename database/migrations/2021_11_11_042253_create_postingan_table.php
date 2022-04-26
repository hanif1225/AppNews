<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postingan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade');
            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('category')
            ->onDelete('cascade');
            $table->longText('gambar')->nullable();
            $table->string('judul')->unique();
            $table->date('tanggal');
            $table->string('lokasi');
            $table->longText('isi');
            $table->string('status')->nullable();
            $table->text('alasan')->nullable();
            $table->string('slug')->unique();
            $table->integer('views');
            $table->integer('like');
            $table->integer('trending');
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
        Schema::dropIfExists('postingan');
    }
}
