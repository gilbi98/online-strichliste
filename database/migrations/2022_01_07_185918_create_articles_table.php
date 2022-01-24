<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price');
            $table->bigInteger('category')->unsigned()->nullable();
            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade');
            $table->bigInteger('tallysheet')->unsigned()->nullable();
            $table->foreign('tallysheet')->references('id')->on('tallysheets')->onDelete('cascade');
            $table->boolean('stock_tracking')->default(0);
            $table->integer('in_stock')->nullable();
            $table->integer('min_stock')->nullable();
            $table->integer('over_min')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
