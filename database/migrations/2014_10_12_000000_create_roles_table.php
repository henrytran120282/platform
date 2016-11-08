<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function(Blueprint $table){
            $table->bigIncrements('id')->unsigned();
            $table->string('name',150);
            $table->text('description')->nullable();
            $table->string('type',50)->nullable();
            $table->longText('permission')->nullable();
            $table->boolean('status')->default(0)->nullable();
            $table->timestamps()->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::drop('roles');
    }
}
