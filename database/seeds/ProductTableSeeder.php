<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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
            ['category_id' => '2', 'product_name' => 'Acelga', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD', "attributes" => [["sku" => "FRUACEK001","unit_name" => "kg","unit_cant" => 10,"price" => 10,"stock" => 10]]],
            ['category_id' => '2', 'product_name' => 'Aji Dulce', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD', "attributes" => [["sku" => "FRUAJIK002","unit_name" => "kg","unit_cant" => 10,"price" => 10,"stock" => 10]]],
            ['category_id' => '2', 'product_name' => 'Aji Picante', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD', "attributes" => [["sku" => "FRUAJIK003","unit_name" => "kg","unit_cant" => 10,"price" => 10,"stock" => 10]]],
            ['category_id' => '2', 'product_name' => 'Ajo', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD', "attributes" => [["sku" => "FRUAJOK004","unit_name" => "kg","unit_cant" => 10,"price" => 10,"stock" => 10]]],
            ['category_id' => '2', 'product_name' => 'Berenjena', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD', "attributes" => [["sku" => "FRUBERK005","unit_name" => "kg","unit_cant" => 10,"price" => 10,"stock" => 10]]],
            ['category_id' => '2', 'product_name' => 'Ciruela', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD', "attributes" => [["sku" => "FRUCIRK006","unit_name" => "kg","unit_cant" => 10,"price" => 10,"stock" => 10],["sku" => "FRUCIRC007","unit_name" => "ce","unit_cant" => 10,"price" => 20,"stock" => 10]]]
        ];

        foreach ($products as $key => $value) {
            $value['slug'] = Str::slug($value['product_name']);
            // $sku = 'FRU'.strtoupper(substr($value['slug'], 0, 3)).'K00'.strval($key);
            $attrs = array_pop($value);
            $product = App\Product::create($value);

            foreach ($attrs as $key => $value) {
                $attributes = new App\ProductAttribute($value);
                $product->product_attributes()->save($attributes);
            }
        }


    }
}
