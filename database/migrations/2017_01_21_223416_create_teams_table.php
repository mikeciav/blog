<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('tag');
            $table->string('country');
            $table->string('logo')->nullable();
            $table->timestamps();
        });

        Schema::create('player_team', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('player_id')->unsigned();
                $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
            $table->integer('team_id')->unsigned();
                $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
        Schema::dropIfExists('player_team');
    }
}
