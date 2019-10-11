<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PositionsTableSeeder extends Seeder
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
            "name" => ["top", "mid", "jg", "support", "adc", "アタッカー", "サポート", "タレット", "スカウト", "オーダー", "エルフ", "ロイヤル", "ウィッチ", "ドラゴン", "ネクロマンサー", "ヴァンパイア", "ビショップ", "タンク", "ヒーラー", "アタッカー", "Fragger", "Support", "IGL", "AWP", "Lurker", "アタッカー", "サポート", "サブアタッカー", "ブリーチャー", "ハードブリーチャー"],
            "game_id" => [1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 3, 3, 3, 3, 3, 3, 3, 7, 7, 7, 8, 8, 8, 8, 8, 9, 9, 9, 9, 9],
        ];

        for ($i = 0; $i < count($datas["name"]); $i++) {
            DB::table("positions")->insert([
                "name" => $datas["name"][$i],
                "game_id" => $datas["game_id"][$i],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        //上記に指定されていないgame_id
        $no_game_id = [4, 5, 6, 10, 11];

        foreach ($no_game_id as $game_id) {
            for ($i = 1; $i <= 5; $i++) {
                DB::table("positions")->insert([
                    "name" => $faker->unique()->word(),
                    "game_id" => $game_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
