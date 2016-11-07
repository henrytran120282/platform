<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('country_id')->unsigned();
            $table->string('country_code')->nullable();
            $table->string('code');
            $table->string('name');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('cities')->unsigned();
            $table->index('name');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('regions');
    }
}
