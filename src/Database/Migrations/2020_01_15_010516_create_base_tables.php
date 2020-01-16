<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('unit') || Schema::hasTable('parameter') || Schema::hasTable('value'))
            return false;
        Schema::create('unit', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->tinyInteger('order')->index()->defaultValue(0);
            $table->timestamps();
        });
        Schema::create('parameter', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->unsignedInteger('unit_id');
            $table->tinyInteger('order')->index()->defaultValue(0);
            $table->tinyInteger('status')->index()->defaultValue(0);
            $table->timestamps();
            $table->foreign('unit_id')->references('id')->on('unit');
        });
        Schema::create('value', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('parameter_id');
            $table->float('value');
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();
            $table->foreign('parameter_id')->references('id')->on('parameter');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('value');
        Schema::dropIfExists('parameter');
        Schema::dropIfExists('unit');
    }
}
