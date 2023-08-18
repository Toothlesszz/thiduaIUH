<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompeteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compete', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->required();
            $table->string('author', 155);
            $table->date('date')->required();
            $table->text('summary')->required();
            $table->longText('content')->required();
            $table->unsignedBigInteger('id_styli')->required();
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
        Schema::dropIfExists('compete');
    }
}
