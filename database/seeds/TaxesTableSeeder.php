<?php

use Illuminate\Database\Seeder;

class TaxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Tax::create([
            'tax_name' => 'iva',
            'description' => 'Impuesto de Valor Añadido',
            'multipler_factor' => 0.16
        ]);
    }
}
