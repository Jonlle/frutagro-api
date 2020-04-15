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
            ['name' => 'all', 'status_id' => '1'],
            ['name' => 'user_management_access', 'status_id' => '1'],
            ['name' => 'permission_create', 'status_id' => '1'],
            ['name' => 'permission_edit', 'status_id' => '1'],
            ['name' => 'permission_show', 'status_id' => '1'],
            ['name' => 'permission_delete', 'status_id' => '1'],
            ['name' => 'permission_access', 'status_id' => '1'],
            ['name' => 'role_create', 'status_id' => '1'],
            ['name' => 'role_edit', 'status_id' => '1'],
            ['name' => 'role_show', 'status_id' => '1'],
            ['name' => 'role_delete', 'status_id' => '1'],
            ['name' => 'role_access', 'status_id' => '1'],
            ['name' => 'user_create', 'status_id' => '1'],
            ['name' => 'user_edit', 'status_id' => '1'],
            ['name' => 'user_show', 'status_id' => '1'],
            ['name' => 'user_delete', 'status_id' => '1'],
            ['name' => 'user_access', 'status_id' => '1'],
            ['name' => 'status_create', 'status_id' => '1'],
            ['name' => 'status_edit', 'status_id' => '1'],
            ['name' => 'status_show', 'status_id' => '1'],
            ['name' => 'status_delete', 'status_id' => '1'],
            ['name' => 'status_access', 'status_id' => '1'],
            ['name' => 'customer_create', 'status_id' => '1'],
            ['name' => 'customer_edit', 'status_id' => '1'],
            ['name' => 'customer_show', 'status_id' => '1'],
            ['name' => 'customer_delete', 'status_id' => '1'],
            ['name' => 'customer_access', 'status_id' => '1'],
            ['name' => 'product_create', 'status_id' => '1'],
            ['name' => 'product_edit', 'status_id' => '1'],
            ['name' => 'product_show', 'status_id' => '1'],
            ['name' => 'product_delete', 'status_id' => '1'],
            ['name' => 'product_access', 'status_id' => '1'],
        ];

        foreach ($permissions as $row) {
            App\Permission::create($row);
        }
    }
}
