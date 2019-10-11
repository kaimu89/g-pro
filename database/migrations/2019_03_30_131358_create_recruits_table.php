<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruits', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("team_id")->nullable();
            $table->unsignedInteger("game_id");
            $table->unsignedInteger("position_id")->nullable();
            $table->unsignedInteger("rank_id")->nullable();
            $table->unsignedInteger("rank_status")->nullable();
            $table->unsignedInteger("staff_id")->nullable();
            $table->unsignedInteger("house")->nullable();
            $table->unsignedInteger("age")->nullable();
            $table->string('content')->nullable();
            $table->string('ab_skill')->nullable();
            $table->string('wel_skill')->nullable();
            $table->text("description")->nullable();
            $table->timestamps();

            $table->foreign("game_id")->references("id")->on("games");
            $table->foreign("position_id")->references("id")->on("positions");
            $table->foreign("rank_id")->references("id")->on("ranks");
            $table->foreign("staff_id")->references("id")->on("staff");
            $table->foreign("team_id")->references("id")->on("teams")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recruits');
    }
}
