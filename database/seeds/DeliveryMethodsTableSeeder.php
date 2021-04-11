<?php

use Illuminate\Database\Seeder;

class DeliveryMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $delivery_methods = [
            ['name' => 'Envío gratis', 'price' => 0.00, 'description' => 'Envío gratis'],
            ['name' => 'Otro estado', 'price' => 3.00, 'description' => 'Envío a otro estado']
        ];

        foreach ($delivery_methods as $row) {
            App\DeliveryMethod::create($row);
        }
    }
}
