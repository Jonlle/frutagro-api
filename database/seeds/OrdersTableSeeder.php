<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = [
            ['status_id' => 'co', 'user_id' => 4, 'user_address_id' => 1, 'delivery_method_id' => 1, 'grand_total' => 100.00, 'item_count' => 1],
            ['status_id' => 'pr', 'user_id' => 4, 'user_address_id' => 1, 'delivery_method_id' => 1, 'grand_total' => 200.00, 'item_count' => 2],
            ['status_id' => 'pe', 'user_id' => 4, 'user_address_id' => 1, 'delivery_method_id' => 1, 'grand_total' => 300.00, 'item_count' => 3],
        ];

        foreach ($orders as $row) {
            $row['order_number'] = substr(Carbon::now()->format('YmdHiv'), 2);
            App\Order::create($row);
        }
    }
}
