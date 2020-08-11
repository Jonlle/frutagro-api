<?php

use Illuminate\Database\Seeder;

class PaymentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payment_types = [
            ['id' => 'transfer', 'description' => 'Transferencia Bancaria'],
            ['id' => 'pagomovil', 'description' => 'Pago Móvil'],
            ['id' => 'efectivo', 'description' => 'Efectivo']
        ];

        foreach ($payment_types as $row) {
            App\PaymentType::create($row);
        }
    }
}
