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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::create('parameter', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->unsignedInteger('unit_id');
            $table->tinyInteger('order')->index()->defaultValue(0);
            $table->tinyInteger('status')->index()->defaultValue(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->foreign('unit_id')->references('id')->on('unit');
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::create('value', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('parameter_id');
            $table->float('value', 16, 4);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->foreign('parameter_id')->references('id')->on('parameter');
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::create('template', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('content', '10240');
            $table->tinyInteger('order')->index()->defaultValue(0);
            $table->tinyInteger('status')->index()->defaultValue(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::create('active_template', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('template_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->foreign('template_id')->references('id')->on('template');
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::create('active_parameter', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('placeholder');
            $table->unsignedInteger('parameter_id');
            $table->unsignedInteger('template_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->foreign('parameter_id')->references('id')->on('parameter');
            $table->foreign('template_id')->references('id')->on('template');
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::create('template_snapshot', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content', 10240);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('template_snapshot');
        Schema::dropIfExists('active_parameter');
        Schema::dropIfExists('active_template');
        Schema::dropIfExists('template');
        Schema::dropIfExists('value');
        Schema::dropIfExists('parameter');
        Schema::dropIfExists('unit');
    }
}
