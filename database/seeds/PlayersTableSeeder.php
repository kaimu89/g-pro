<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Game;
use App\Models\Position;
use App\Models\Rank;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        $users = User::all();
        $games = Game::all();
        $positions = Position::all();
        $ranks = Rank::all();

        DB::table("players")->insert([
            "ign" => $faker->userName,
            "user_id" => 1,
            "game_id" => 1,
            "position_id" => 1,
            "rank_id" => 1,
            "proama" => $faker->randomElement([0, 1]),
            "description" => $faker->realText(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);



        // $datas = [
        //     "ign" => ["yasu", "matu", "riku", "kaito", "ryo", "tittya", "nana", "rino", "kota", "kiyo", "kyou", "akki", "asu", "miona"],
        //     "user_id" => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
        //     "game_id" => [1, 2, 3, 7, 8, 9, 1, 2, 3, 7, 8, 9, 1, 2],
        //     "position_id" => [1, 7, 12, 20, 23, 29, 5, 10, 15, 18, 21, 26, 2, 8],
        //     "rank_id" => [4, 10, 18, 42, 49, 66, 1, 12, 20, 45, 50, 68, 8, 15],
        //     "proama" => [0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1],
        //     "description" => ["sglkshdfs", "gkhailh;gjga;j", "galkhao;ng;ia0", "reszbgrsigbsil", "gklbglraebrliaagliblib", "goah;oahg;aoaoa", "rkgblriaiualrugialb", "ga.blalgblabla;ioj;gioa", "kjaglbilabliblgblg", "fsjofsjffdssd", "sosnosnposmpofs;f", "slkknfslnslfs", "lgsnosns", "lsjoihsoijosf"]
        // ];

        for ($i = 1; $i <= $users->count() / 2; $i++) {
            $game_id = rand(1, $games->count());
            $positions = Position::Where('game_id', $game_id)->get()->pluck('id')->toArray();
            $ranks = Rank::Where('game_id', $game_id)->get()->pluck('id')->toArray();
            DB::table("players")->insert([
                "ign" => $faker->userName,
                "user_id" => $i,
                "game_id" => $game_id,
                "position_id" => $faker->randomElement($positions),
                "rank_id" => $faker->randomElement($ranks),
                "proama" => $faker->randomElement([0, 1]),
                "description" => $faker->realText(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
