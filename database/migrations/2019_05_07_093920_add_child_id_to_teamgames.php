<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChildIdToTeamgames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teamgames', function (Blueprint $table) {
            $table->unsignedInteger("child_id")->nullable()->after('team_id');

            $table->foreign("child_id")->references("id")->on("children")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::disableForeignKeyConstraints();
        Schema::table('teamgames', function (Blueprint $table) {
            // $table->dropUnique('xxxxxxxxxx_unique_index');
            $table->dropForeign('teamgames_child_id_foreign');
            // $table->dropColumn('child_id');
        });
        // Schema::enableForeignKeyConstraints();
    }
}
