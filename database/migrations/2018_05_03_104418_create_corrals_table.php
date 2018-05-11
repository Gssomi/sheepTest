<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Corral;

class CreateCorralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corrals', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->text('name')->unique();
            $table->timestamps();
        });

        $corrals = ["first", "second", "thrid", "fourth"];
        foreach ($corrals as $corral) {
            Corral::create(["name" => $corral]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corrals');
    }
}
