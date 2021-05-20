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
            ['category_id' => '2', 'product_name' => 'Acelga', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD', "attributes" => [["sku" => "VEGACEK001","unit_name" => "kg","unit_cant" => 10,"price" => 10,"stock" => 10]], "suppliers" => [1]],
            ['category_id' => '2', 'product_name' => 'Aji Dulce', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD', "attributes" => [["sku" => "VEGAJIK002","unit_name" => "kg","unit_cant" => 10,"price" => 10,"stock" => 10]], "suppliers" => [2]],
            ['category_id' => '2', 'product_name' => 'Aji Picante', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD', "attributes" => [["sku" => "VEGAJIK003","unit_name" => "kg","unit_cant" => 10,"price" => 10,"stock" => 10]], "suppliers" => [3]],
            ['category_id' => '2', 'product_name' => 'Ajo', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD', "attributes" => [["sku" => "VEGAJOK004","unit_name" => "kg","unit_cant" => 10,"price" => 10,"stock" => 10]], "suppliers" => [4]],
            ['category_id' => '2', 'product_name' => 'Berenjena', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD', "attributes" => [["sku" => "VEGBERK005","unit_name" => "kg","unit_cant" => 10,"price" => 10,"stock" => 10]], "suppliers" => [5]],
            ['category_id' => '2', 'product_name' => 'Ciruela', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD', "attributes" => [["sku" => "VEGCIRK006","unit_name" => "kg","unit_cant" => 10,"price" => 10,"stock" => 10],["sku" => "VEGCIRC007","unit_name" => "ce","unit_cant" => 10,"price" => 20,"stock" => 10]], "suppliers" => [1,2]],
            ['category_id' => '1', 'product_name' => 'Fresa', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD', "attributes" => [["sku" => "FRUFREK007","unit_name" => "kg","unit_cant" => 10,"price" => 10,"stock" => 10]], "suppliers" => [3,4]],
            ['category_id' => '3', 'product_name' => 'Cebolla', 'slug' => '', 'description' => 'Product description', 'currency_code_id' => 'USD', "attributes" => [["sku" => "VERCEBK008","unit_name" => "kg","unit_cant" => 10,"price" => 10,"stock" => 10]], "suppliers" => [5]]
        ];

        foreach ($products as $value) {
            $value['slug'] = Str::slug($value['product_name']);
            $suppliers =  array_pop($value);
            $attrs = array_pop($value);
            $product = App\Product::create($value);

            $product->suppliers()->attach($suppliers);

            foreach ($attrs as $attr) {
                $attributes = new App\ProductAttribute($attr);
                $product->product_attributes()->save($attributes);
            }
        }
    }
}
