<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('country_id')->unsigned();
            $table->string('country_code')->nullable();
            $table->string('region_id')->unsigned();
            $table->string('region_code')->nullable();
            $table->string('name');
            $table->double('latitude');
            $table->double('longitude');
            $table->index('name');
            $table->foreign('country_id')->references('id')->on('country')->onDelete('cascade');
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cities');
    }
}
