<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoutUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scout_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("team_id");
            $table->unsignedInteger("player_id")->nullable();
            $table->boolean('look')->default(false);
            $table->timestamps();

            $table->foreign("team_id")->references("id")->on("teams")->onDelete('cascade');
            $table->foreign("player_id")->references("id")->on("players")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scout_users');
    }
}
