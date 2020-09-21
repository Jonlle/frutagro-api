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
            ['category_id' => '2', 'product_name' => 'Acelga', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD'],
            ['category_id' => '2', 'product_name' => 'Aji Dulce', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD'],
            ['category_id' => '2', 'product_name' => 'Aji Picante', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD'],
            ['category_id' => '2', 'product_name' => 'Ajo', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD'],
            ['category_id' => '2', 'product_name' => 'Berenjena', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD'],
            ['category_id' => '2', 'product_name' => 'Ciruela', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD']
        ];

        foreach ($products as $key => $value) {
            $value['slug'] = Str::slug($value['product_name']);
            $sku = 'FRU'.strtoupper(substr($value['slug'], 0, 3)).'K00'.strval($key);
            $product = App\Product::create($value);
            $attributes = new App\ProductAttribute(['sku'=> $sku, 'unit_name'=> 'Kg', 'unit_cant'=> 10, 'price'=> 10, 'stock'=> 10]);
            $product->product_attributes()->save($attributes);
        }


    }
}
