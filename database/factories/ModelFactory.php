<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Entities\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->unique()->userName,
        'password' => $password ?: $password = bcrypt('123456'),
        'email' => $faker->unique()->safeEmail,
        'first_name'  => $faker->unique()->firstName,
        'last_name'  => $faker->unique()->lastName,
        'type'  => $faker->randomElement(['U','M']),
        'remember_token'  => str_random(10),
        'actived'  => '1',
    ];
});


$factory->define(App\Entities\Holding::class, function (Faker\Generator $faker) {

    return [
        'group_name' => $faker->unique()->company,
        'legal_name' => $faker->unique()->safeEmail,
        'ruc' => $faker->unique()->buildingNumber,
        'address' => $faker->unique()->address,
        'subscription_date'  => $faker->date(),
    ];
});
