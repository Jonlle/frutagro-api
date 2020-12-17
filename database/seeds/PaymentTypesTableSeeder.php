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
            ['id' => 'cash', 'description' => 'Cash - Efectivo'],
            ['id' => 'mobile_payment', 'description' => 'Mobile payment - Pago Móvil'],
            ['id' => 'bank_transfer', 'description' => 'Bank transfer - Transferencia Bancaria']
        ];

        foreach ($payment_types as $row) {
            App\PaymentType::create($row);
        }
    }
}
