
<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');

        $datas = [
            "name" => [
                "Challenger", "GrandMaster", "Master", "Diamond", "platinum", "Gold", "Silver", "Bronze", "征服者", "エース", "クラウン", "ダイアモンド", "プラチナ", "ゴールド", "シルバー", "ブロンズ", "Master", "AA", "A", "B", "C", "D", "Beginner", "GrandMaster", "Master", "UltraDiamond", "SuperDiamond", "Diamond", "UltraPlatinum", "SuperPlatinum", "Platinum", "UltraGold", "SuperGold", "Gold", "UltraSilver", "SuperSilver", "Silver", "UltraBronze", "SuperBronze", "Bronze", "Rookie", "X", "S+", "S", "A", "B", "C",
                "GLOBAL ELITE", "SMFC", "LEM", "LEGENDARY EAGLE", "DMG", "MASETER GUARDIAN ELITE", "MASTER GUARDIAN2", "MASTER GUARDIAN1", "GOLD NOVA MASTER", "GOLD NOBA3", "GOLD NOBA2", "GOLD NOVA1", "SILVER ELITE MASTER", "SILVER ELITE", "SILVER4", "SILVER3", "SILVER2", "SILVER1", "Diamond", "Platinum", "Gold", "Silver", "Bronze", "Copper", "GrandMaster", "Master", "Diamond", "Platinum", "Gold", "Silver", "Bronze", "TOP100", "エリート", "ゴールド", "シルバー", "ブロンズ"
            ],
            "game_id" => [1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 3, 3, 3, 3, 3, 3, 3, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 7, 7, 7, 7, 7, 7, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 9, 9, 9, 9, 9, 9, 10, 10, 10, 10, 10, 10, 10, 11, 11, 11, 11, 11],
        ];

        for ($i = 0; $i < count($datas["name"]); $i++) {
            DB::table("ranks")->insert([
                "name" => $datas["name"][$i],
                "game_id" => $datas["game_id"][$i],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $no_game_id = [4, 6,];

        foreach ($no_game_id as $game_id) {
            for ($i = 1; $i <= 5; $i++) {
                DB::table("ranks")->insert([
                    "name" => $faker->word(),
                    "game_id" => $game_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
