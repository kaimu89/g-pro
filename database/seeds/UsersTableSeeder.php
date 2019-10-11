<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Team;
use App\Models\Child;
use Illuminate\Database\Eloquent\Factory;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');


        DB::table("users")->insert([
            'email' => 'test@test.com',
            'password' => bcrypt('testtest'),
            'leader' => 0,
            'first_name' => $faker->lastName,
            'last_name' => $faker->firstName,
            'user_name' => 'テストユーザー',
            'birthday' => $faker->dateTimeBetween('-30 years', '-10years')->format('Y-m-d'),
            'gender' => $faker->randomElement([0, 1]),
            'picture' => '/logo/test.jpeg',
            'team_id' => 1,
            'child_id' => null,
            'twitter' => $faker->shuffle('abcdefghij'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        $teams = Team::all();
        $children = Child::all();

        foreach ($teams as $team) {
            for ($i = 0; $i < 1; $i++) {
                DB::table("users")->insert([
                    'email' => $faker->unique()->safeEmail,
                    'password' => bcrypt('asdfghjkl'),
                    'leader' => $i == 0 ? 0 : null,
                    'first_name' => $faker->lastName,
                    'last_name' => $faker->firstName,
                    'user_name' => $faker->unique()->userName,
                    'birthday' => $faker->dateTimeBetween('-30 years', '-10years')->format('Y-m-d'),
                    'gender' => $faker->randomElement([0, 1]),
                    'picture' => '/logo/test.jpeg',
                    'team_id' => $team->id,
                    'child_id' => null,
                    'twitter' => $faker->shuffle('abcdefghij'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        foreach ($children as $child) {
            for ($i = 0; $i < 1; $i++) {
                DB::table("users")->insert([
                    'email' => $faker->unique()->safeEmail,
                    'password' => bcrypt('asdfghjkl'),
                    'leader' => $i == 0 ? 0 : null,
                    'first_name' => $faker->lastName,
                    'last_name' => $faker->firstName,
                    'user_name' => $faker->unique()->userName,
                    'birthday' => $faker->dateTimeBetween('-30 years', '-10years')->format('Y-m-d'),
                    'gender' => $faker->randomElement([0, 1]),
                    'picture' => '/logo/test.jpeg',
                    'team_id' => null,
                    'child_id' => $child->id,

                    'twitter' => $faker->shuffle('abcdefghij'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        // //チーム(0) メンバーあり childあり メンバーあり
        // //10個
        // $datas = [
        //     "team_id" => [1, 1, 1, null, null, null, null, null, null, null,],
        //     "child_id" => [null, null, null, 1, 1, 1, 2, 2, 2, 2],
        //     "leader" => [0, null, null, 0, null, null, 0, null, null, null,],
        //     "user_name" => ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j",],
        // ];

        // for ($i = 0; $i < count($datas["team_id"]); $i++) {
        //     DB::table("users")->insert([
        //         "team_id" => $datas["team_id"][$i],
        //         "child_id" => $datas["child_id"][$i],
        //         "leader" => $datas["leader"][$i],
        //         "user_name" => $datas["user_name"][$i],
        //         "email" => $datas["user_name"][$i] . 'gmail.com',
        //         "password" => bcrypt('asdfghjkl'),
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }

        // //チーム(0) メンバーあり childあり メンバーなし
        // //5個
        // $datas2 = [
        //     "team_id" => [2, 2, 2, 2, 2],
        //     "child_id" => [null, null, null, null, null,],
        //     "leader" => [0, null, null, null, null,],
        //     "user_name" => ["k", "l", "m", "n", "o",],
        // ];

        // for ($i = 0; $i < count($datas2["team_id"]); $i++) {
        //     DB::table("users")->insert([
        //         "team_id" => $datas2["team_id"][$i],
        //         "child_id" => $datas2["child_id"][$i],
        //         "leader" => $datas2["leader"][$i],
        //         "user_name" => $datas2["user_name"][$i],
        //         "email" => $datas2["user_name"][$i] . 'gmail.com',
        //         "password" => bcrypt('asdfghjkl'),
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }

        // //チーム(0) メンバーなし childあり メンバーあり
        // //5個
        // $datas3 = [
        //     "team_id" => [3, null, null, null, null,],
        //     "child_id" => [null, 3, 3, 3, 3],
        //     "leader" => [0, 0, null, null, null,],
        //     "user_name" => ["z", "p", "q", "r", "s",],
        // ];

        // for ($i = 0; $i < count($datas3["team_id"]); $i++) {
        //     DB::table("users")->insert([
        //         "team_id" => $datas3["team_id"][$i],
        //         "child_id" => $datas3["child_id"][$i],
        //         "leader" => $datas3["leader"][$i],
        //         "user_name" => $datas3["user_name"][$i],
        //         "email" => $datas3["user_name"][$i] . 'gmail.com',
        //         "password" => bcrypt('asdfghjkl'),
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }

        // //チーム(1) メンバーあり
        // //5個
        // $datas4 = [
        //     "team_id" => [4, 4, 4, 4, 4],
        //     "child_id" => [null, null, null, null, null,],
        //     "leader" => [0, null, null, null, null],
        //     "user_name" => ["t", "u", "v", "w", "x",],
        // ];

        // for ($i = 0; $i < count($datas4["team_id"]); $i++) {
        //     DB::table("users")->insert([
        //         "team_id" => $datas4["team_id"][$i],
        //         "child_id" => $datas4["child_id"][$i],
        //         "leader" => $datas4["leader"][$i],
        //         "user_name" => $datas4["user_name"][$i],
        //         "email" => $datas4["user_name"][$i] . 'gmail.com',
        //         "password" => bcrypt('asdfghjkl'),
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }

        // //チーム(1) メンバーなし
        // //１個
        // $datas5 = [
        //     "team_id" => [5],
        //     "child_id" => [null],
        //     "leader" => [0],
        //     "user_name" => ["y",],
        // ];

        // for ($i = 0; $i < count($datas5["team_id"]); $i++) {
        //     DB::table("users")->insert([
        //         "team_id" => $datas5["team_id"][$i],
        //         "child_id" => $datas5["child_id"][$i],
        //         "leader" => $datas5["leader"][$i],
        //         "user_name" => $datas5["user_name"][$i],
        //         "email" => $datas5["user_name"][$i] . 'gmail.com',
        //         "password" => bcrypt('asdfghjkl'),
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }

        // //予備軍
        // //10個
        $datas6 = [
            // "team_id" => [null, null, null, null, null, null, null, null, null, null,],
            // "child_id" => [null, null, null, null, null, null, null, null, null, null,],
            // "leader" => [null, null, null, null, null, null, null, null, null, null,],
            "user_name" => ["aa", "bb", "cc", "dd", "ee", "ff", "gg", "hh", "ii", "jj",],
        ];

        // for ($i = 0; $i < count($datas6["user_name"]); $i++) {
        //     DB::table("users")->insert([
        //         "team_id" => null,
        //         "child_id" => null,
        //         "leader" => null,
        //         "user_name" => $datas6["user_name"][$i],
        //         "email" => $datas6["user_name"][$i] . 'gmail.com',
        //         "password" => bcrypt('asdfghjkl'),
        //         'picture' => '/logo/test.jpeg',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }
    }
}



/*
型

$datas = [
            "team_id" => [],
            "child_id" => [],
            "leader" => [],
            "user_name" => ["",],
            "email" => ["@gmail.com",],
            "password" => ["asdewqasd",],
        ];

        for ($i = 0; $i < count($datas["team_id"]); $i++) {
            DB::table("users")->insert([
                "team_id" => $datas["team_id"][$i],
                "child_id" => $datas["child_id"][$i],
                "leader" => $datas["leader"][$i],
                "user_name" => $datas["user_name"][$i],
                "email" => $datas["email"][$i],
                "password" => bcrypt($datas["password"][$i]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

*/
