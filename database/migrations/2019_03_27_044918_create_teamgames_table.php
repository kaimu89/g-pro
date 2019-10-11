<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamgamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teamgames', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("team_id")->nullable();
            $table->unsignedInteger("game_id");
            $table->timestamps();
            $table->foreign("team_id")->references("id")->on("teams")->onDelete('cascade');
            $table->foreign("game_id")->references("id")->on("games");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teamgames');
    }
}
