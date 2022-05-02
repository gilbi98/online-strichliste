<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('number');
            $table->date('term');
            $table->bigInteger('user')->unsigned()->nullable();
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->double('amount');
            $table->double('total');
            $table->bigInteger('invoice')->unsigned()->nullable();
            $table->foreign('invoice')->references('id')->on('invoices')->onDelete('cascade');
            $table->integer('open')->default(1);
            $table->integer('payment_methode')->nullable();
            $table->date('payment_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
