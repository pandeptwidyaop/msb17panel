<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionTwosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_twos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('candidate_id',9);
            $table->integer('ketepatan_jawaban')->default(0);
            $table->integer('visi_misi')->default(0);
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
        Schema::table('section_twos', function (Blueprint $table){
          $table->foreign('candidate_id')->references('id')->on('candidates')->onUpdate('cascade')->onDelete('cascade');
          $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_twos');
    }
}
