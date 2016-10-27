<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableThemeMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_meta', function (Blueprint $table) {
            $table->bigIncrements('meta_id')->unsigned();
            $table->bigInteger('theme_id')->default(0)->unsigned();
            $table->string('meta_group');
            $table->string('meta_key');
            $table->longText('meta_value');
            $table->index('theme_id');
            $table->index('meta_key');
            $table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('theme_meta');
    }
}
