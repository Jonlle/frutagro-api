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

        $owner_permissions = [
            'role' => 'owner',
            'permissions' => [1]
        ];
        $permissions = App\Permission::all()->toArray();
        Log::debug('permissions: '.json_encode($permissions));
        Log::debug('type of permissions: '.gettype($permissions));
        $filtered = Arr::where($permissions, function ($value, $key) {
            return !Str::contains($value['name'], ['all', 'user_', 'role_', 'permission_']);
        });
        Log::debug('filtered: '.json_encode($filtered));
        $admin_permissions = [
            'role' => 'admin',
            'permissions' => Arr::pluck($filtered, 'id')
        ];
        Log::debug('admin_permissions: '.json_encode($admin_permissions));
        $result = Arr::where($filtered, function ($value, $key) {
            return Str::endsWith($value['name'], ['show', 'access']);
        });
        Log::debug('result: '.json_encode($result));
        $user_permissions = [
            'role' => 'user',
            'permissions' => Arr::pluck($result, 'id')
        ];
        Log::debug('user_permissions: '.json_encode($user_permissions));
        array_push($role_permissions, $owner_permissions, $admin_permissions, $user_permissions);
        Log::debug('role_permissions: '.json_encode($role_permissions));
        foreach ($role_permissions as $row) {
            $role = App\Role::find($row['role']);
            $role->permissions()->attach($row['permissions']);
            $role->permissions()->sync($row['permissions']);
        }
    }
}
