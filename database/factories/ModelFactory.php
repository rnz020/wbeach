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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'username'  => $faker->unique()->userName,
        'fullname'  => $faker->unique()->firstName . ' '.$faker->unique()->lastName,
        'role'  => $faker->randomElement(['U','M']),
        'email'  => $faker->unique()->safeEmail,
      //  'password'  => $password ?: $password = bcrypt('123456'),
        'password'  => \Hash::make('123456'),
        'active'  => '1',
        'remember_token'  => str_random(10),
    ];
});


$factory->define(App\Holding::class, function (Faker\Generator $faker) {

    return [
        'group_name' => $faker->unique()->company,
        'legal_name' => $faker->unique()->safeEmail,
        'ruc' => $faker->unique()->buildingNumber,
        'address' => $faker->unique()->address,
        'subscription_date'  => $faker->date(),
    ];
});
