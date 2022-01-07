<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('nickname');
            $table->string('email')->unique();
            $table->double('guthaben')->default(0);
            $table->integer('role')->default(0);
            $table->integer('pc1')->nullable();
            $table->integer('pc2')->nullable();
            $table->integer('pc3')->nullable();
            $table->integer('pc4')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
