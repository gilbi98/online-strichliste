<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('created_from')->unsigned()->nullable();
            $table->foreign('created_from')->references('id')->on('users')->onDelete('cascade');
            $table->integer('bills_total');
            $table->integer('bills_open');
            $table->double('amount_total');
            $table->double('amount_open');
            $table->integer('positions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
