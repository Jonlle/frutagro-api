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
            ['id' => 'frutas', 'slug' => 'frutas', 'description' => 'Frutas'],
            ['id' => 'vegetales', 'slug' => 'vegetales', 'description' => 'Vegetales'],
        ];

        foreach ($categories as $row) {
            App\Category::create($row);
        }
    }
}
