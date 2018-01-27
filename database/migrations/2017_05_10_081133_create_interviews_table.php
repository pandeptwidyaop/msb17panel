<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->increments('id');
            $table->char('candidate_id',9);
            $table->integer('kemampuan_logika_berpikir')->default(0);
            $table->integer('kemampuan_menjawab_pertanyaan')->default(0);
            $table->integer('komunikatif')->default(0);
            $table->integer('percaya_diri')->default(0);
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('interviews', function(Blueprint $table){
          $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interviews');
    }
}
