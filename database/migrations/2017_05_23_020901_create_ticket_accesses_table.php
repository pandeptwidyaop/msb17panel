<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_accesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_number')->unique();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('ticket_accesses', function (Blueprint $table){
          $table->foreign('unique_number')->references('unique_number')->on('tickets')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ticket_accesses');
    }
}
