<?php

use Illuminate\Database\Seeder;

class ContactDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contactDetails = ['address' => 'Mercado Mayor de Coche, Calle Zea, Caracas 1090, Distrito Capital', 'phone' => '02121234455', 'mobile' => '04162133470', 'email' => 'distribuidorafrutagro@gmail.com'];

        App\Models\ContactDetails::create($contactDetails);
    }
}
