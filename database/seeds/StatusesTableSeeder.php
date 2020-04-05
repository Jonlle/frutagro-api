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
            ['id' => '01', 'description' => 'enabled'],
            ['id' => '02', 'description' => 'disabled'],
            ['id' => '03', 'description' => 'active'],
            ['id' => '04', 'description' => 'inactive']
        ];

        foreach ($statuses as $row) {
            App\Status::create($row);
        }
    }
}
