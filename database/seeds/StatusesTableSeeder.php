<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['id' => 'a', 'description' => 'active'],
            ['id' => 'i', 'description' => 'inactive'],
            ['id' => 'e', 'description' => 'enabled'],
            ['id' => 'd', 'description' => 'disabled']
        ];

        foreach ($statuses as $row) {
            App\Status::create($row);
        }
    }
}
