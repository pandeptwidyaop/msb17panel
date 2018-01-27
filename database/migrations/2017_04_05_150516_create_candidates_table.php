<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->char('id',9);
            $table->integer('number')->default(0);
            $table->string('name');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->enum('religion',['islam','hindu','kristen','budha']);
            $table->text('address');
            $table->string('phone_number');
            $table->enum('campus',['renon','jimbaran']);
            $table->enum('study_program',['SI','SK','MI']);
            $table->char('semester',2);
            $table->string('organization');
            $table->text('organization_experience');
            $table->text('achievements');
            $table->text('interest_talents');
            $table->text('reason');
            $table->text('social_media');
            $table->string('picture')->default('images/miss.jpg');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('candidates', function(Blueprint $table){
          $table->primary('id');
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
        Schema::dropIfExists('candidates');
    }
}
