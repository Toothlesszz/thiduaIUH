<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',20)->unique()->required();
            $table->string('name')->required();
            $table->string('image', 155);
            $table->date('birthday')->required();
            $table->string('address')->required();
            $table->string('email', 155)->required();
            $table->string('course', 50);
            $table->string('password')->required();
            $table->integer('level')->required();
            $table->unsignedBigInteger('id_depart')->required();
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
        Schema::dropIfExists('users');
    }
}
