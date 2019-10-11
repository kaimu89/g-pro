<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeamIdChildIdToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger("team_id")->nullable()->after('id');
            $table->unsignedInteger("child_id")->nullable()->after('team_id');

            $table->foreign("team_id")->references("id")->on("teams")->onDelete('set null');
            $table->foreign("child_id")->references("id")->on("children")->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->dropColumn('team_id');
            // $table->dropColumn('child_id');
            $table->dropForeign('users_team_id_foreign');
            $table->dropForeign('users_child_id_foreign');
        });
    }
}
