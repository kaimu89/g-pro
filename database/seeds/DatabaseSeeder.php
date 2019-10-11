<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GamesTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(RanksTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(ChildrenTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PlayersTableSeeder::class);
        $this->call(TeamgamesTableSeeder::class);
        $this->call(StaffsTableSeeder::class);
        $this->call(RecruitsTableSeeder::class);
    }
}
