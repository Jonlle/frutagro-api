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
        $payment_methods = [
            ['payment_type_id' => 'cash', 'reference_number' => null, 'financial_entity_id' => null],
            ['payment_type_id' => 'tranfer', 'reference_number' => '058303', 'financial_entity_id' => 22],
            ['payment_type_id' => 'mobilepayment', 'reference_number' => '190792', 'financial_entity_id' => 9],
        ];

        foreach ($payment_methods as $row) {
            $payment_method = new App\PaymentMethod($row);

            $payment = App\Payment::create();
            $payment->payment_methods()->save($payment_method);
        }
    }
}
