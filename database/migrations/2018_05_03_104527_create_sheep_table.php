<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Sheep;

class CreateSheepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheep', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->text('name')->unique();
            $table->integer('corral_id')->unsigned();
            $table->integer('status')->default(0);
            $table->timestamps();
        });

        Schema::table('sheep', function($table) {
            $table->foreign('corral_id')->references('id')->on('corral');
        });

        $sheeps = array("one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten");
        
        foreach ($sheeps as $sheep) {
            Sheep::create(["name" => $sheep, "corral_id" => rand(1, 4), "status" => 0]);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sheep');
    }
}
