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
            ['id' => 'av', 'description' => 'Available - Disponible'],
            ['id' => 'co', 'description' => 'Completed - Completado'],
            ['id' => 'di', 'description' => 'Disabled - Deshabilitado'],
            ['id' => 'en', 'description' => 'Enabled - Habilitado'],
            ['id' => 'in', 'description' => 'Inactive - Inactivo'],
            ['id' => 'ne', 'description' => 'New - Nuevo'],
            ['id' => 'pe', 'description' => 'Pending - Pendiente'],
            ['id' => 'pr', 'description' => 'Processed - Procesada'],
            ['id' => 'un', 'description' => 'Unavailable - Agotado'],
            ['id' => 've', 'description' => 'Verified - Verificado'],
        ];

        foreach ($statuses as $row) {
            App\Status::create($row);
        }
    }
}
