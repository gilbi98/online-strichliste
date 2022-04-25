<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user')->unsigned()->nullable();
            $table->foreign('user')->references('id')->on('users');
            $table->bigInteger('bill')->unsigned()->nullable();
            $table->foreign('bill')->references('id')->on('bills')->onDelete('cascade');
            $table->bigInteger('article')->unsigned()->nullable();
            $table->foreign('article')->references('id')->on('articles');
            $table->integer('quantity');
            $table->double('amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions');
    }
}
