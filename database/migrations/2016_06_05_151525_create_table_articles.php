<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('post_author')->default(0)->unsigned();
            $table->longText('post_content');
            $table->text('post_title');
            $table->text('post_excerpt');
            $table->string('post_status',20)->default("publish");
            $table->string('comment_status',20)->default("open");
            $table->string('post_password',20);
            $table->string('post_name');
            $table->bigInteger('post_parent')->default(0);
            $table->string('guid');
            $table->integer('menu_order')->default(0);
            $table->string('menu_group');
            $table->string('post_type',20);
            $table->integer('post_hit')->default(0);
            $table->string('post_mime_type',200)->default("post");
            $table->timestamps();
            $table->foreign('post_author')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
