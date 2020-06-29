<?php

use Illuminate\Database\Seeder;

class AddressTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address_types = [
            ['id' => 'domicilio', 'description' => 'Domicilio'],
            ['id' => 'laboral', 'description' => 'Laboral'],
            ['id' => 'comercial', 'description' => 'Comercial']
        ];

        foreach ($address_types as $row) {
            App\AddressType::create($row);
        }
    }
}
