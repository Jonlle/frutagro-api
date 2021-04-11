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
    $role = $faker->randomElement([3, 4]);
    $evenValidator = function($username) {
       return strlen($username) < 16;
    };
    $document_type_id = $role == 3 ? $faker->randomElement(['ci', 'rif', 'p']) : 'rif';
    $document = $role == 3 ? $faker->nationalId : $faker->taxpayerIdentificationNumber;
    $name = $role == 3 ? $faker->name : $faker->company;

    return [
        'username' => $faker->valid($evenValidator)->userName,
        'document_type_id' => $document_type_id,
        'role_id' => $role,
        'name' => $name,
        'document' => $document,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    ];
});
