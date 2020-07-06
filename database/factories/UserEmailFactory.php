<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserEmail;
use Faker\Generator as Faker;

$factory->define(UserEmail::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'principal' => '1'
    ];
});
