<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanCoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_coin', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('pengajuan');
            $table->string('status')->nullable();
            $table->string('nominal')->nullable();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade');
            $table->foreignId('reward_id')->references('id')->on('reward')
            ->onDelete('cascade');
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
        Schema::dropIfExists('pengajuan_coin');
    }
}
