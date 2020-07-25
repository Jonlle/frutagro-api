<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['category_name' => 'Frutas', 'slug' => 'frutas', 'description' => 'Frutas'],
            ['category_name' => 'Vegetales', 'slug' => 'vegetales', 'description' => 'Vegetales'],
            ['category_name' => 'Verduras', 'slug' => 'verduras', 'description' => 'Verduras'],
        ];

        foreach ($categories as $row) {
            App\Category::create($row);
        }
    }
}
