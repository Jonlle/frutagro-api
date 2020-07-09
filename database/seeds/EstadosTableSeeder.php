<?php

use Illuminate\Database\Seeder;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            ['estado' => 'Amazonas', 'iso' => 'VE-Z'],
            ['estado' => 'Anzoátegui', 'iso' => 'VE-B'],
            ['estado' => 'Apure', 'iso' => 'VE-C'],
            ['estado' => 'Aragua', 'iso' => 'VE-D'],
            ['estado' => 'Barinas', 'iso' => 'VE-E'],
            ['estado' => 'Bolívar', 'iso' => 'VE-F'],
            ['estado' => 'Carabobo', 'iso' => 'VE-G'],
            ['estado' => 'Cojedes', 'iso' => 'VE-H'],
            ['estado' => 'Delta Amacuro', 'iso' => 'VE-Y'],
            ['estado' => 'Falcón', 'iso' => 'VE-I'],
            ['estado' => 'Guárico', 'iso' => 'VE-J'],
            ['estado' => 'Lara', 'iso' => 'VE-K'],
            ['estado' => 'Mérida', 'iso' => 'VE-L'],
            ['estado' => 'Miranda', 'iso' => 'VE-M'],
            ['estado' => 'Monagas', 'iso' => 'VE-N'],
            ['estado' => 'Nueva Esparta', 'iso' => 'VE-O'],
            ['estado' => 'Portuguesa', 'iso' => 'VE-P'],
            ['estado' => 'Sucre', 'iso' => 'VE-R'],
            ['estado' => 'Táchira', 'iso' => 'VE-S'],
            ['estado' => 'Trujillo', 'iso' => 'VE-T'],
            ['estado' => 'Vargas', 'iso' => 'VE-X'],
            ['estado' => 'Yaracuy', 'iso' => 'VE-U'],
            ['estado' => 'Zulia', 'iso' => 'VE-V'],
            ['estado' => 'Distrito Capital', 'iso' => 'VE-A'],
            ['estado' => 'Dependencias Federales', 'iso' => 'VE-W']
        ];

        foreach ($estados as $row) {
            App\Estado::create($row);
        }
    }
}
