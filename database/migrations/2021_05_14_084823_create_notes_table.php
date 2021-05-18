<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
           $table->increments('id');  //unique 
           $table->string('title');
           $table->string('body');
           $table->unsignedBigInteger('user_id');
           $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')
                 ->onDelete('cascade');
           $table->rememberToken();
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
        Schema::dropIfExists('notes');
    }
}
