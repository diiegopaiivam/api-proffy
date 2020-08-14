<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClassSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_schedule', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('week_day')->nullable();
            $table->integer('from')->nullable();
            $table->integer('to')->nullable();
            $table->unsignedInteger('class_id');

            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('class_schedule');
    }
}
