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
        $role_permissions = [];
        $permissions = App\Permission::all()->toArray();

        $owner_permissions = [
            'role' => 'owner',
            'permissions' => [1]
        ];

        $filtered = Arr::where($permissions, function ($value, $key) {
            return !Str::contains($value['name'], ['all', 'user_', 'role_', 'permission_']);
        });

        $admin_permissions = [
            'role' => 'admin',
            'permissions' => Arr::pluck($filtered, 'id')
        ];

        $result = Arr::where($filtered, function ($value, $key) {
            return Str::endsWith($value['name'], ['show', 'access']);
        });

        $user_permissions = [
            'role' => 'customer',
            'permissions' => Arr::pluck($result, 'id')
        ];

        array_push($role_permissions, $owner_permissions, $admin_permissions, $user_permissions);

        foreach ($role_permissions as $row) {
            $role = App\Role::find($row['role']);
            $role->permissions()->attach($row['permissions']);
        }
    }
}
