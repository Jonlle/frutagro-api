<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['id' => 'all', 'status_id' => '01'],
            ['id' => 'create', 'status_id' => '01'],
            ['id' => 'read', 'status_id' => '01'],
            ['id' => 'update', 'status_id' => '01'],
            ['id' => 'delete', 'status_id' => '01']
        ];

        foreach ($permissions as $row) {
            App\Permission::create($row);
        }
    }
}
