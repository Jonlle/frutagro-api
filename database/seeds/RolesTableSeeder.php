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
            ['name' => 'owner', 'description' => 'Usuario Propietario'],
            ['name' => 'admin', 'description' => 'Usuario Administrador'],
            ['name' => 'person', 'description' => 'Usuario Cliente Persona'],
            ['name' => 'business', 'description' => 'Usuario Cliente Negocio']
        ];

        foreach ($roles as $row) {
            App\Role::create($row);
        }
    }
}
