<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['category_id' => '2', 'sku' => '', 'product_name' => 'Acelga', 'slug' => '', 'unit_name' => 'Gr', 'unit_cant' => '100', 'price' => 100.00, 'description' => 'Product description', 'currency_code_id' => 'USD'],
            ['category_id' => '2', 'sku' => '', 'product_name' => 'Aji Dulce', 'slug' => '', 'unit_name' => 'Gr', 'unit_cant' => '100', 'price' => 100.00, 'description' => 'Product description', 'currency_code_id' => 'USD'],
            ['category_id' => '2', 'sku' => '', 'product_name' => 'Aji Picante', 'slug' => '', 'unit_name' => 'Gr', 'unit_cant' => '100', 'price' => 100.00, 'description' => 'Product description', 'currency_code_id' => 'USD'],
            ['category_id' => '2', 'sku' => '', 'product_name' => 'Ajo', 'slug' => '', 'unit_name' => 'Gr', 'unit_cant' => '100', 'price' => 100.00, 'description' => 'Product description', 'currency_code_id' => 'USD'],
            ['category_id' => '2', 'sku' => '', 'product_name' => 'Berenjena', 'slug' => '', 'unit_name' => 'Gr', 'unit_cant' => '100', 'price' => 100.00, 'description' => 'Product description', 'currency_code_id' => 'USD'],
            ['category_id' => '2', 'sku' => '', 'product_name' => 'Ciruela', 'slug' => '', 'unit_name' => 'Gr', 'unit_cant' => '100', 'price' => 100.00, 'description' => 'Product description', 'currency_code_id' => 'USD']
        ];

        $i = 1;
        foreach ($products as $row) {
            $row['slug'] = Str::slug($row['product_name']);
            $row['sku'] = 'FRU'.strtoupper(substr($row['slug'], 0, 3)).$row['unit_name'][0].'00'.strval($i);
            App\Product::create($row);
            $i++;
        }
    }
}
