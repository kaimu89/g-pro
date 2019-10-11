<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        // 'name' => $faker->name,
        // 'email' => $faker->unique()->safeEmail,
        // 'email_verified_at' => now(),
        // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // 'remember_token' => Str::random(10),

        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('asdfghjkl'),
        'first_name' => $faker->lastName,
        'last_name' => $faker->firstName,
        'user_name' => $faker->unique()->userName,
        'birthday' => $faker->dateTimeBetween('-30 years', '-10years')->format('Y-m-d'),
        'gender' => $faker->randomElement([0, 1]),
        'picture' => '/logo/zTsKlj8dt289lI2j24Hvnsw0hr8mrDbAs6PdjS22.jpeg',
        'twitter' => $faker->shuffle('abcdefghij'),
    ];
});
