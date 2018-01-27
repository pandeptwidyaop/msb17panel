<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id')->unsigned();
            $table->integer('aspect_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('evaluations', function (Blueprint $table){
          $table->foreign('section_id')->references('id')->on('sections')->onUpdate('cascade')->onDelete('cascade');
          $table->foreign('aspect_id')->references('id')->on('aspects')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
