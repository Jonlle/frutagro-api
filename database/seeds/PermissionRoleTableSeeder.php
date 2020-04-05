<?php

use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_permissions = [
            [
                'role' => 'owner',
                'permissions' => ['all']
            ],
            [
                'role' => 'admin',
                'permissions' => ['create', 'read', 'update']
            ],
            [
                'role' => 'user',
                'permissions' => ['read']
            ]
        ];

        foreach ($role_permissions as $row) {
            $role = App\Role::find($row['role']);
            $role->permissions()->attach($row['permissions']);
            $role->permissions()->sync($row['permissions']);
        }
    }
}
