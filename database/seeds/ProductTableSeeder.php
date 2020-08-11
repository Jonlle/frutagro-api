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

        foreach ($products as $key => $value) {
            $value['slug'] = Str::slug($value['product_name']);
            $value['sku'] = 'FRU'.strtoupper(substr($value['slug'], 0, 3)).$value['unit_name'][0].'00'.strval($key);
            App\Product::create($value);
        }
    }
}
