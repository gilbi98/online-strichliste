<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date');
            $table->bigInteger('user')->unsigned()->nullable();
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('article')->unsigned()->nullable();
            $table->foreign('article')->references('id')->on('articles')->onDelete('cascade');
            $table->integer('quantity');
            $table->double('cost');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
