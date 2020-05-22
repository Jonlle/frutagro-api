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
            ['name' => 'all', 'status_id' => 'ac'],
            ['name' => 'user_management_access', 'status_id' => 'ac'],
            ['name' => 'permission_create', 'status_id' => 'ac'],
            ['name' => 'permission_edit', 'status_id' => 'ac'],
            ['name' => 'permission_show', 'status_id' => 'ac'],
            ['name' => 'permission_delete', 'status_id' => 'ac'],
            ['name' => 'permission_access', 'status_id' => 'ac'],
            ['name' => 'role_create', 'status_id' => 'ac'],
            ['name' => 'role_edit', 'status_id' => 'ac'],
            ['name' => 'role_show', 'status_id' => 'ac'],
            ['name' => 'role_delete', 'status_id' => 'ac'],
            ['name' => 'role_access', 'status_id' => 'ac'],
            ['name' => 'user_create', 'status_id' => 'ac'],
            ['name' => 'user_edit', 'status_id' => 'ac'],
            ['name' => 'user_show', 'status_id' => 'ac'],
            ['name' => 'user_delete', 'status_id' => 'ac'],
            ['name' => 'user_access', 'status_id' => 'ac'],
            ['name' => 'status_create', 'status_id' => 'ac'],
            ['name' => 'status_edit', 'status_id' => 'ac'],
            ['name' => 'status_show', 'status_id' => 'ac'],
            ['name' => 'status_delete', 'status_id' => 'ac'],
            ['name' => 'status_access', 'status_id' => 'ac'],
            ['name' => 'customer_create', 'status_id' => 'ac'],
            ['name' => 'customer_edit', 'status_id' => 'ac'],
            ['name' => 'customer_show', 'status_id' => 'ac'],
            ['name' => 'customer_delete', 'status_id' => 'ac'],
            ['name' => 'customer_access', 'status_id' => 'ac'],
            ['name' => 'product_create', 'status_id' => 'ac'],
            ['name' => 'product_edit', 'status_id' => 'ac'],
            ['name' => 'product_show', 'status_id' => 'ac'],
            ['name' => 'product_delete', 'status_id' => 'ac'],
            ['name' => 'product_access', 'status_id' => 'ac'],
        ];

        foreach ($permissions as $row) {
            App\Permission::create($row);
        }
    }
}
