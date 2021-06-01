<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelsNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('noteid');
            $table->unsignedBigInteger('labelid');
            
            $table->string('label');
          
            $table->unique(['user_id','label']); 
            $table->timestamps();
           
        });

        Schema::table('labels_notes', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('noteid')->references('id')->on('notes')->onDelete('cascade');
            $table->foreign('labelid')->references('id')->on('labels')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labels_notes');
    }
}
