<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id')->unsigned();
            $table->integer('concept_id')->unsigned();
            $table->string('role');
            $table->timestamps();
        });
        Schema::table('assessment_roles', function(Blueprint $table){
          $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('concept_id')->references('id')->on('concepts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessment_roles');
    }
}
