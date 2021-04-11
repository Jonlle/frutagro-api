<?php

use Illuminate\Database\Seeder;

class OrderProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order_products = [
            ['order' => 1, 'product' => 1, 'data' => ['tax_id' => 1, 'quantity' => 1, 'unit' => 'Gr']],
            ['order' => 2, 'product' => 1, 'data' => ['tax_id' => 1, 'quantity' => 1, 'unit' => 'Gr']],
            ['order' => 2, 'product' => 2, 'data' => ['tax_id' => 1, 'quantity' => 1, 'unit' => 'Gr']],
            ['order' => 3, 'product' => 2, 'data' => ['tax_id' => 1, 'quantity' => 1, 'unit' => 'Gr']],
            ['order' => 3, 'product' => 3, 'data' => ['tax_id' => 1, 'quantity' => 2, 'unit' => 'Gr']]
        ];

        foreach ($order_products as $row) {
            $order = App\Order::find($row['order']);
            $order->products()->attach($row['product'], $row['data']);
        }
    }
}
