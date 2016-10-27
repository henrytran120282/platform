<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWidgetGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widget_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('theme_id')->default(0)->unsigned();
            $table->string('name');
            $table->index('theme_id');
            $table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('widget_groups');
    }
}
