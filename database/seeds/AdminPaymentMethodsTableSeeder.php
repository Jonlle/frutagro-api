<?php

use Illuminate\Database\Seeder;

class AdminPaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adm_pay_methods = [
            ['payment_type_id' => 'cash'],
            ['payment_type_id' => 'bank_transfer', 'financial_entity_id' => 24, 'target_acount' => '01346721092097800910', 'document_type_id' => 'ci', 'document' => 'V21375756', 'target_name' => 'Jennifer Cadiz', 'file_image' => 'logo_account_24.png', 'file_path' => '/images/logoPaymentMethods'],
            ['payment_type_id' => 'mobile_payment', 'financial_entity_id' => 24, 'target_acount' => '04162133470', 'document_type_id' => 'ci', 'document' => 'V21375756', 'target_name' => 'Jennifer Cadiz', 'file_image' => 'logo_mobile_payment_24.png', 'file_path' => '/images/logoPaymentMethods']
        ];

        foreach ($adm_pay_methods as $row) {
            App\AdminPaymentMethod::create($row);
        }
    }
}
