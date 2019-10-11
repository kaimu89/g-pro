<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("team_id")->nullable();
            $table->string("name")->unique();
            $table->string("picture")->nullable();
            $table->string("email");
            $table->string("top");
            $table->text("description")->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('children');
    }
}
