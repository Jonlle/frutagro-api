<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['id' => 'ac', 'description' => 'Active - Activo'],
            ['id' => 'in', 'description' => 'Inactive - Inactivo'],
            ['id' => 'av', 'description' => 'Available - Disponible'],
            ['id' => 'un', 'description' => 'Unavailable - Agotado'],
            ['id' => 'en', 'description' => 'Enabled - Habilitado'],
            ['id' => 'di', 'description' => 'Disabled - Deshabilitado']
        ];

        foreach ($statuses as $row) {
            App\Status::create($row);
        }
    }
}
