<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_meta', function (Blueprint $table) {
            $table->bigIncrements('meta_id')->unsigned();
            $table->integer('user_id')->default(0)->unsigned();
            $table->string('meta_key');
            $table->longText('meta_value');
            $table->index('user_id');
            $table->index('meta_key');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_meta');
    }
}
