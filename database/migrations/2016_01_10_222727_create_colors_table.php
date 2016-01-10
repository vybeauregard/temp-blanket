<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('hex');
            $table->timestamps();
        });
        
        DB::table('colors')->insert([
            ["name" => "teal", "hex" => "05495a"],
            ["name" => "meadow", "hex" => "7e824d"],
            ["name" => "camel", "hex" => "b79261"],
            ["name" => "gold", "hex" => "d6923d"],
            ["name" => "claret", "hex" => "7d1b2a"],
            ["name" => "copper", "hex" => "963d24"],
            ["name" => "lime", "hex" => "c2b144"],
            ["name" => "khaki", "hex" => "4c482e"],
            ["name" => "grape", "hex" => "6b465b"],
            ["name" => "magenta", "hex" => "9f4995"],
            ["name" => "pale rose", "hex" => "b17b8a"],
            ["name" => "spice", "hex" => "e17649"],
            ["name" => "raspberry", "hex" => "ae4569"],
            ["name" => "wisteria", "hex" => "9a8abe"],
            ["name" => "aster", "hex" => "2868a8"],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('colors');
    }
}
