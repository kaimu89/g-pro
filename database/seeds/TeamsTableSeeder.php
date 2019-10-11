<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');

        //11個
        $name = ["DetonatioN Gaming", "AXIZ", "Burning Core", "Crest Gaming", "Rascal Jester", "Sengoku Gaming", "Unsold Staff Gaming", "V3 Esports", "super gaming", "ultra gaming", "pokemon"];


        for ($i = 0; $i < count($name); $i++) {
            DB::table("teams")->insert([
                "name" => $name[$i],
                "proama" => $i == 0 ? 0 : $faker->randomElement([0, 1]),
                "picture" => '/logo/test.jpeg',
                "email" => 'a@gmail.com',
                "hp" => 'https://www.youtube.com/',
                "top" => $faker->name,
                "description" => $faker->realText(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
