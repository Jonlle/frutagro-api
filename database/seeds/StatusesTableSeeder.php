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
            ['id' => '1', 'description' => 'active'],
            ['id' => '2', 'description' => 'inactive'],
            ['id' => '3', 'description' => 'enabled'],
            ['id' => '4', 'description' => 'disabled']
        ];

        foreach ($statuses as $row) {
            App\Status::create($row);
        }
    }
}
