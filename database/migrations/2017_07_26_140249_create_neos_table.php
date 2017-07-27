<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('reference');
            $table->string('name');
            $table->double('speed');
            $table->boolean('is_hazardous');

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
        Schema::drop('neos');
    }
}
