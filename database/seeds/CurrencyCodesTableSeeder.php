<?php

use Illuminate\Database\Seeder;

class CurrencyCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency_codes = [
            ['id' => 'USD', 'currency_name' => 'Venezuelan Bolivar', 'currency_symbol' => 'Bs.S', 'exchange_rate' => '197000'],
            ['id' => 'VEF', 'currency_name' => 'United States Dollar', 'currency_symbol' => '$', 'exchange_rate' => '1'],
        ];

        foreach ($currency_codes as $row) {
            App\CurrencyCode::create($row);
        }
    }
}
