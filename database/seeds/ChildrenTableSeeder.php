<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\Game;
use PhpParser\Node\Stmt\Foreach_;

class ChildrenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');

        // $data = [
        //     "team_id" => [1, 1, 3,],
        //     "name" => ["popular", "sent", "mederal"],
        //     "mail" => ["a@gmail.com", "a@gmail.com", "a@gmail.com",],
        //     "top" => ["横田", "横田", "横田",],
        //     "description" => ["よろしくお願いします", "よろしくお願いします", "よろしくお願いします",],
        // ];

        $games = Game::all();

        $pros = Team::Where('proama', 0)->get();

        foreach ($pros as $pro) {
            for ($i = 1; $i <= count($games); $i++) {
                DB::table("children")->insert([
                    "team_id" => $pro->id,
                    "name" => $faker->unique()->word(),
                    "email" => 'a@gmail.com',
                    "top" => $faker->lastName . $faker->firstName,
                    "description" => $faker->realText(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
