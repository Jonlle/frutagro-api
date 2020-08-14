<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Supplier;
use Faker\Generator as Faker;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        'supplier_name' => $faker->company,
        'contact_name' => $faker->name,
        'contact_title' => $faker->jobTitle,
        'address' => $faker->streetAddress,
        'code_postal' => $faker->postcode,
        'city' => $faker->city,
        'country' => 'Venezuela',
        'phone' => substr($faker->e164PhoneNumber, -10),
        'email' => $faker->unique()->safeEmail
    ];
});
