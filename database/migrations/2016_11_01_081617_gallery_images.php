<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GalleryImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_images', function(Blueprint $table){
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('gallery_id')->unsigned();
            $table->string('image_name', 150);
            $table->string('image_title', 150);
            $table->text('image_description');
            $table->boolean('image_status');
            $table->index('gallery_id');
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gallery_images');
    }
}
