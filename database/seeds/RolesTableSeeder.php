<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['id' => 'owner', 'status_id' => 'a', 'description' => 'Usuario Propietario'],
            ['id' => 'admin', 'status_id' => 'a', 'description' => 'Usuario Administrador'],
            ['id' => 'customer', 'status_id' => 'a', 'description' => 'Usuario Cliente'],
        ];

        foreach ($roles as $row) {
            App\Role::create($row);
        }
    }

}
