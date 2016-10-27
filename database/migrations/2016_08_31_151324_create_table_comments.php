<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('post_id')->default(0)->unsigned();
            $table->string('author');
            $table->string('email')->unique();
            $table->string('url');
            $table->longText('content');
            $table->boolean('approved')->default(false);
            $table->bigInteger('parent')->default(0);
            $table->integer('user_id')->default(0)->unsigned();
            $table->timestamps();
            $table->index('post_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
