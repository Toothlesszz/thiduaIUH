<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylizedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stylized', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->required();
            $table->string('criteria_1')->required();
            $table->string('criteria_2');
            $table->string('criteria_3');
            $table->string('criteria_4');
            $table->string('criteria_5');
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
        Schema::dropIfExists('stylized');
    }
}
