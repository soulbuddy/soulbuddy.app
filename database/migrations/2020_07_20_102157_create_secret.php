<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecret extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secrets', function (Blueprint $table) {
            $table->bigIncrements('id');
	    $table->text('description')->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->text('body');
            $table->double('overall_rating')->default(0.0);
            $table->boolean('is_rated')->default(false);
            $table->boolean('is_free')->default(false);
	    $table->integer('price')->unsigned();
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
        Schema::dropIfExists('secrets');
    }
}
