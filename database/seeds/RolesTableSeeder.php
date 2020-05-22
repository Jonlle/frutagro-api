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
            ['id' => 'owner', 'status_id' => 'ac', 'description' => 'Usuario Propietario'],
            ['id' => 'admin', 'status_id' => 'ac', 'description' => 'Usuario Administrador'],
            ['id' => 'person', 'status_id' => 'ac', 'description' => 'Usuario Cliente Persona'],
            ['id' => 'business', 'status_id' => 'ac', 'description' => 'Usuario Cliente Negocio']
        ];

        foreach ($roles as $row) {
            App\Role::create($row);
        }
    }

}
