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
            ['name' => 'owner', 'status_id' => 'ac', 'description' => 'Usuario Propietario'],
            ['name' => 'admin', 'status_id' => 'ac', 'description' => 'Usuario Administrador'],
            ['name' => 'person', 'status_id' => 'ac', 'description' => 'Usuario Cliente Persona'],
            ['name' => 'business', 'status_id' => 'ac', 'description' => 'Usuario Cliente Negocio']
        ];

        foreach ($roles as $row) {
            App\Role::create($row);
        }
    }
}
