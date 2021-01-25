<?php

use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Supplier::class,5)->create()->each(function ($supplier) {
            $supplier->bank_data()->save(factory(App\BankData::class)->make());
        });
    }
}
