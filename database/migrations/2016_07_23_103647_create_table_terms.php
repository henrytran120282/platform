<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTerms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->bigIncrements('term_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->string('taxonomy');
            $table->longText('description');
            $table->bigInteger('parent')->default(0)->unsigned();
            $table->bigInteger('term_group')->default(0);
            $table->index('slug');
            $table->index('name');
            $table->index('taxonomy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('terms');
    }
}
