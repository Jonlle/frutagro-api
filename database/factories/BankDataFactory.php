<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BankData;
use Faker\Generator as Faker;

$factory->define(BankData::class, function (Faker $faker) {
    return [
        'payment_type_id' => $faker->randomElement(['mobile_payment', 'bank_transfer']),
        'financial_entity_id' => $faker->numberBetween($min = 1, $max = 32),
        // 'supplier_id' => factory(\App\Supplier::class),
        'target_acount' => $faker->bankAccountNumber,
        'document_type_id' => $faker->randomElement(['ci', 'rif', 'p']),
        'document' => $faker->nationalId,
        'target_name' => $faker->name,
        'file_image' => 'frutagro_payment_methods.png',
        'file_path' => '/images/logoPaymentMethods'
    ];
});
