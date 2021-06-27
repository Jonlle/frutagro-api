<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = [
            ['order_id' => 1, 'amount' => 100.00, "payment_methods" => ['payment_type_id' => 'cash', 'reference_number' => null, 'financial_entity_id' => null]],
            ['order_id' => 2, 'amount' => 200.00, "payment_methods" => ['payment_type_id' => 'bank_transfer', 'reference_number' => '058303', 'financial_entity_id' => 22]],
            ['order_id' => 3, 'amount' => 150.00, "payment_methods" => ['payment_type_id' => 'mobile_payment', 'reference_number' => '190792', 'financial_entity_id' => 9]],
            ['order_id' => 3, 'amount' => 150.00, "payment_methods" => ['payment_type_id' => 'bank_transfer', 'reference_number' => '191298', 'financial_entity_id' => 9]]
        ];

        foreach ($payments as $value) {
            $pay_method = array_pop($value);
            $payment_method = new App\PaymentMethod($pay_method);
            $payment = App\Payment::create($value);
            $payment->payment_method()->save($payment_method);
        }
    }
}
