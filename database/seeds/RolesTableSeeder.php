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
            ['id' => 'owner', 'status_id' => '01', 'description' => 'Usuario Propietario'],
            ['id' => 'admin', 'status_id' => '01', 'description' => 'Usuario Administrador'],
            ['id' => 'user', 'status_id' => '01', 'description' => 'Usuario'],
        ];

        foreach ($roles as $row) {
            App\Role::create($row);
        }
    }

}
