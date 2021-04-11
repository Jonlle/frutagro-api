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
        App\AdminPaymentMethod::create(['payment_type_id' => 'cash']);

        $bank_data = [
            ['payment_type_id' => 'bank_transfer', 'financial_entity_id' => 24, 'target_acount' => '01346721092097800910', 'document_type_id' => 'ci', 'document' => 'V21375756', 'target_name' => 'Jennifer Cadiz', 'file_image' => 'logo_account_24.png', 'file_path' => '/images/logoPaymentMethods'],
            ['payment_type_id' => 'mobile_payment', 'financial_entity_id' => 24, 'target_acount' => '04162133470', 'document_type_id' => 'ci', 'document' => 'V21375756', 'target_name' => 'Jennifer Cadiz', 'file_image' => 'logo_mobile_payment_24.png', 'file_path' => '/images/logoPaymentMethods']
        ];

        foreach ($bank_data as $row) {
            $payment_method_model = new App\AdminPaymentMethod(['payment_type_id' => $row['payment_type_id']]);
            $bank_data_model = App\BankData::create($row);
            $bank_data_model->admin_payments_methods()->save($payment_method_model);
        }
    }
}
