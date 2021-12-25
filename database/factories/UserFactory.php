<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'full_name' => $faker->name,
        'email' => 'admin@admin.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$8bbaTR04bwCpNcTN//9kU.wL3UAsYdYxwSY.41pPeCYQN5v1HR12O', // password
        'is_admin' => 1
    ];
});
