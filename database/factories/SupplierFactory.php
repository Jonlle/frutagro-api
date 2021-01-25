<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Supplier;
use Faker\Generator as Faker;

$factory->define(Supplier::class, function (Faker $faker) {
    $document_type_id = $faker->randomElement(['ci', 'rif', 'p']);
    $document = $document_type_id == 'rif' ? $faker->taxpayerIdentificationNumber : $faker->nationalId;

    return [
        'supplier_name' => $faker->company,
        'contact_name' => $faker->name,
        'contact_title' => $faker->jobTitle,
        'document_type_id' => $document_type_id,
        'document' => $document,
        'postal_code' => $faker->postcode,
        'state_id' =>  24,
        'city_id' => $faker->numberBetween($min = 149, $max = 150),
        'address' => $faker->streetAddress,
        'phone' => substr($faker->e164PhoneNumber, -10),
        'email' => $faker->unique()->safeEmail
    ];
});
