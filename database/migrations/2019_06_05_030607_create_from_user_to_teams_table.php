<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFromUserToTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('from_user_to_teams', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("recruit_id")->nullable();
            $table->unsignedInteger("team_id");
            $table->unsignedInteger("player_id")->nullable();
            $table->unsignedInteger("user_id")->nullable();
            $table->boolean('look')->default(false);
            $table->timestamps();

            $table->foreign("recruit_id")->references("id")->on("recruits")->onDelete('set null');
            $table->foreign("team_id")->references("id")->on("teams")->onDelete('cascade');
            $table->foreign("player_id")->references("id")->on("players")->onDelete('cascade');
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('from_user_to_teams');
    }
}
