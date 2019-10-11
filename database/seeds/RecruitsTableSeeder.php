<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\Game;
use App\Models\Position;
use App\Models\Rank;

class RecruitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        $pros = Team::Where('proama', 0)->get();
        $amas = Team::Where('proama', 1)->get();
        $games = Game::all();

        foreach ($pros as $pro) {

            for ($i = 0; $i < rand(1, 5); $i++) {
                $game = Game::find(rand(1, count($games)));
                $positions = Position::Where('game_id', $game->id)->get()->pluck('id');
                $ranks = Rank::Where('game_id', $game->id)->get()->pluck('id');
                DB::table("recruits")->insert([
                    "game_id" => $game->id,
                    "position_id" => $faker->randomElement($positions),
                    "rank_id" => $faker->randomElement($ranks),
                    "house" => $faker->randomElement([0, 1]),
                    "age" => rand(0, 4),
                    "description" => $faker->realText(),
                    "team_id" => $pro->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        foreach ($amas as $ama) {

            $positions = Position::Where('game_id', $ama->teamgame->game->id)->get()->pluck('id');
            $ranks = Rank::Where('game_id', $ama->teamgame->game->id)->get()->pluck('id');
            for ($i = 0; $i < rand(1, 5); $i++) {
                DB::table("recruits")->insert([
                    "game_id" => $ama->teamgame->game->id,
                    "position_id" => $faker->randomElement($positions),
                    "rank_id" => $faker->randomElement($ranks),
                    "house" => $faker->randomElement([0, 1]),
                    "age" => rand(0, 4),
                    "description" => $faker->realText(),
                    "team_id" => $ama->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }




        // $datas = [
        //     "team_id" => [1, 1, 1, 2, 2, 2, 3, 3, 3, 4, 4, 4, 5, 5, 5],
        //     "game_id" => [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
        //     "position_id" => [1, 2, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
        //     "rank_id" => [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
        //     "house" => [0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 0, 1],
        //     "age" => [0, 2, 3, 4, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1],
        //     "description" => ["agh;js;odfnbos;di", "gjfao;dsso;ijoisgoisg", "ghsoihaihgaihg", "aighiaghoianoaig", "gkahoibaibn", "aghoiahoia", "よろしくお願いします", "よろしくお願いします", "よろしくお願いします", "よろしくお願いします", "よろしくお願いします", "よろしくお願いします", "よろしくお願いします", "よろしくお願いします", "よろしくお願いします",],
        // ];

        // for ($i = 0; $i < count($datas["game_id"]); $i++) {
        //     DB::table("recruits")->insert([
        //         "game_id" => $datas["game_id"][$i],
        //         "position_id" => $datas["position_id"][$i],
        //         "rank_id" => $datas["rank_id"][$i],
        //         "house" => $datas["house"][$i],
        //         "age" => $datas["age"][$i],
        //         "description" => $datas["description"][$i],
        //         "team_id" => $datas["team_id"][$i],
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }

        // $datas2 = [
        //     "game_id" => [1, 1, 1, 1, 1],
        //     "position_id" => [1, 1, 1, 1, 1],
        //     "rank_id" => [1, 1, 1, 1, 1],
        //     "house" => [0, 0, 1, 1, 1],
        //     "age" => [1, 2, 3, 4, 1],
        //     "description" => ["よろしくお願いします", "よろしくお願いします", "よろしくお願いします", "よろしくお願いします", "よろしくお願いします",],
        //     "team_id" => [11, 11, 11, 11, 11],
        // ];

        // for ($i = 0; $i < count($datas2["game_id"]); $i++) {
        //     DB::table("recruits")->insert([
        //         "game_id" => $datas2["game_id"][$i],
        //         "position_id" => $datas2["position_id"][$i],
        //         "rank_id" => $datas2["rank_id"][$i],
        //         "house" => $datas2["house"][$i],
        //         "age" => $datas2["age"][$i],
        //         "description" => $datas2["description"][$i],
        //         "team_id" => $datas2["team_id"][$i],
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }

        // $datas3 = [
        //     "team_id" => [1, 1, 1, 1, 1],
        //     'game_id' => [1, 1, 1, 1, 1],
        //     "staff_id" => [1, 1, 1, 1, 1],
        //     "content" => ["業務管理", "業務管理", "業務管理", "業務管理", "業務管理"],
        //     "ab_skill" => ["word", "word", "word", "word", "word"],
        //     "wel_skill" => ["word", "word", "word", "word", "word"],
        //     "description" => ["よろしくお願いします", "よろしくお願いします", "よろしくお願いします", "よろしくお願いします", "よろしくお願いします"],
        // ];

        // for ($i = 0; $i < count($datas3["staff_id"]); $i++) {
        //     DB::table("recruits")->insert([
        //         "team_id" => $datas3["team_id"][$i],
        //         "game_id" => $datas3["game_id"][$i],
        //         "staff_id" => $datas3["staff_id"][$i],
        //         "content" => $datas3["content"][$i],
        //         "ab_skill" => $datas3["ab_skill"][$i],
        //         "wel_skill" => $datas3["wel_skill"][$i],
        //         "description" => $datas3["description"][$i],
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }
    }
}
