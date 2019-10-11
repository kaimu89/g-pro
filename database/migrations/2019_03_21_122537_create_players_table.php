<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //ok
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->string("ign");
            $table->unsignedInteger("user_id")->nullable();
            $table->unsignedInteger("game_id");
            $table->unsignedInteger("position_id");
            $table->unsignedInteger("rank_id");
            $table->unsignedInteger("proama");
            $table->text("description")->nullable();
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("game_id")->references("id")->on("games");
            $table->foreign("position_id")->references("id")->on("positions");
            $table->foreign("rank_id")->references("id")->on("ranks");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
