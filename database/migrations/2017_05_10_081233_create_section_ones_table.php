<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionOnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_ones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('interview_id')->unsigned();
            $table->integer('kemampuan_menjawab_pertanyaan')->default(0);
            $table->integer('fashion_show')->default(0);
            $table->integer('catwalk')->default(0);
            $table->integer('body_language')->default(0);
            $table->integer('ekspresi')->default(0);
            $table->integer('kecantikan')->default(0);
            $table->integer('public_speaking')->default(0);
            $table->integer('sikap')->default(0);
            $table->integer('percaya_diri')->default(0);
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('section_ones', function (Blueprint $table){
          $table->foreign('interview_id')->references('id')->on('interviews')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('section_ones');
    }
}
