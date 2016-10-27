<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTermRelationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_relationships', function (Blueprint $table) {
            $table->bigInteger('object_id')->default(0)->unsigned();
            $table->bigInteger('term_taxonomy_id')->default(0)->unsigned();
            $table->bigInteger('term_order')->default(0);
            $table->primary(['object_id', 'term_taxonomy_id']);
            $table->index('term_taxonomy_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('term_relationships');
    }
}
