<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorsProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('color_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('colors_projects', function(Blueprint $table) {
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('colors_projects');
    }
}
