<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['tag' => 'Centrado en el cliente'],
            ['tag' => 'Liderazgo'],
            ['tag' => 'Excelencia en la ejecución'],
            ['tag' => 'Aspiración'],
        ];

        foreach ($tags as $row) {
            App\Models\Tag::create($row);
        }
    }
}
