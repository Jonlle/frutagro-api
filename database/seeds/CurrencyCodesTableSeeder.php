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
            ['id' => 'VES', 'currency_name' => 'Bolívar Soberano', 'currency_symbol' => 'Bs.S', 'exchange_rate' => 365000, 'default' => '0'],
            ['id' => 'USD', 'currency_name' => 'United States Dollar', 'currency_symbol' => '$', 'exchange_rate' => 1, 'default' => '1'],
        ];

        foreach ($currency_codes as $row) {
            App\CurrencyCode::create($row);
        }
    }
}
