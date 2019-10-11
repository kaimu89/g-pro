<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GamesTableSeeder extends Seeder
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
            "name" => ["League of Legends", "PUBG", "Shadowverse", "大乱闘スマッシュブラザーズ", "street fighter", "FORTNITE", "スプラトゥーン2", "CS:GO", "RainbowSix|Siege", "Overwatch", "FIFA"],
            "type" => ["PC", "PC", "スマホ", "テレビ", "テレビ", "PC", "テレビ", "PC", "PC", "PC", "テレビ"],
            "genre" => ["MOBA", "TPS", "OCG", "格闘", "格闘", "TPS", "TPS", "FPS", "FPS", "FPS", "スポーツ"],
            "corporation" => ["Riot Games", "DMM GAMES", "Cygames", "Nintendo", "CAPCOM", "Epic Games", "Nintendo", "Valve", " Ubisoft Entertainment", "BLIZZARD ENTERTAINMENT", "Electronic Arts"],
            "url" => ["https://jp.leagueoflegends.com/ja", "http://pubg.dmm.com", "https://shadowverse.jp/", "https://www.smashbros.com/ja_JP/", "http://www.capcom.co.jp/sfv/", "https://www.epicgames.com/fortnite/ja/home", "https://www.nintendo.co.jp/switch/aab6a/index.html", "https://blog.counter-strike.net/", "http://www.ubisoft.co.jp/r6s/", "https://playoverwatch.com/ja-jp/", "https://www.easports.com/jp/fifa"]
        ];

        for ($i = 0; $i < count($datas["name"]); $i++) {
            DB::table("games")->insert([
                "name" => $datas["name"][$i],
                "picture" => '/logo/test.jpeg',
                "type" => $datas["type"][$i],
                "genre" => $datas["genre"][$i],
                "description" => $faker->realText(),
                "corporation" => $datas["corporation"][$i],
                "url" => $datas["url"][$i],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
