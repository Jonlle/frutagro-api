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
            ['id' => 'VES', 'currency_name' => 'Bolívar Soberano', 'currency_symbol' => 'Bs.S', 'exchange_rate' => 1950000],
            ['id' => 'USD', 'currency_name' => 'Dólar estadounidense', 'currency_symbol' => '$', 'exchange_rate' => 1, 'default' => '1'],
            ['id' => 'EUR', 'currency_name' => 'Euro', 'currency_symbol' => '€', 'exchange_rate' => 0.82, 'status_id' => 'di'],
            ['id' => 'COP', 'currency_name' => 'Peso colombiano', 'currency_symbol' => '$', 'exchange_rate' => 3565, 'status_id' => 'di'],
        ];

        foreach ($currency_codes as $row) {
            App\CurrencyCode::create($row);
        }
    }
}
