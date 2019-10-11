<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\Game;
use App\Models\Child;

class TeamgamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $datas = [
        //     "team_id" => [1, 1, 1, 1, 2, 2, 2, 2, 3, 3, 3, 3, 4, 5,],
        //     "game_id" => [1, 2, 3, 4, 1, 2, 3, 4, 1, 2, 3, 4, 1, 1,],
        // ];

        // for ($i = 0; $i < count($datas["team_id"]); $i++) {
        //     DB::table("teamgames")->insert([
        //         "team_id" => $datas["team_id"][$i],
        //         "game_id" => $datas["game_id"][$i],
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }

        // $datas2 = [
        //     "child_id" => [1, 2, 3],
        //     "game_id" => [1, 2, 1],
        // ];

        // for ($i = 0; $i < count($datas2["child_id"]); $i++) {
        //     DB::table("teamgames")->insert([
        //         "child_id" => $datas2["child_id"][$i],
        //         "game_id" => $datas2["game_id"][$i],
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }
        $faker = Faker\Factory::create('ja_JP');
        $games = Game::all();
        $pros = Team::Where('proama', 0)->get();
        $amas = Team::Where('proama', 1)->get();

        foreach ($pros as $pro) {
            for ($i = 1; $i <= count($games); $i++) {
                DB::table("teamgames")->insert([
                    "team_id" => $pro->id,
                    "game_id" => $i,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        foreach ($amas as $ama) {
            DB::table("teamgames")->insert([
                "team_id" => $ama->id,
                "game_id" => rand(1, count($games)),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        //ゲームのカウントだけ回す
        for ($i = 1; $i <= $games->count(); $i++) {
            $children = Child::Where('team_id', $i)->get();

            // foreach ($children as $child) {
            //     DB::table("teamgames")->insert([
            //         "child_id" => $child->id,
            //         "game_id" => $faker->unique(true)->numberBetween(1, $games->count()),
            //         'created_at' => Carbon::now(),
            //         'updated_at' => Carbon::now(),
            //     ]);
            // }

            $r = 1;
            for ($t = 0; $t < $children->count(); $t++) {
                if ($t == 0) {
                    $r = 1;
                }
                DB::table("teamgames")->insert([
                    "child_id" => $children[$t]->id,
                    "game_id" => $r,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                $r++;
            }
        }
    }
}
