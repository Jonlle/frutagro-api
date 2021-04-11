<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['state' => 'Amazonas', 'iso' => 'VE-X'],
            ['state' => 'Anzoátegui', 'iso' => 'VE-B'],
            ['state' => 'Apure', 'iso' => 'VE-C'],
            ['state' => 'Aragua', 'iso' => 'VE-D'],
            ['state' => 'Barinas', 'iso' => 'VE-E'],
            ['state' => 'Bolívar', 'iso' => 'VE-F'],
            ['state' => 'Carabobo', 'iso' => 'VE-G'],
            ['state' => 'Cojedes', 'iso' => 'VE-H'],
            ['state' => 'Delta Amacuro', 'iso' => 'VE-Y'],
            ['state' => 'Falcón', 'iso' => 'VE-I'],
            ['state' => 'Guárico', 'iso' => 'VE-J'],
            ['state' => 'Lara', 'iso' => 'VE-K'],
            ['state' => 'Mérida', 'iso' => 'VE-L'],
            ['state' => 'Miranda', 'iso' => 'VE-M'],
            ['state' => 'Monagas', 'iso' => 'VE-N'],
            ['state' => 'Nueva Esparta', 'iso' => 'VE-O'],
            ['state' => 'Portuguesa', 'iso' => 'VE-P'],
            ['state' => 'Sucre', 'iso' => 'VE-R'],
            ['state' => 'Táchira', 'iso' => 'VE-S'],
            ['state' => 'Trujillo', 'iso' => 'VE-T'],
            ['state' => 'Vargas', 'iso' => 'VE-W'],
            ['state' => 'Yaracuy', 'iso' => 'VE-U'],
            ['state' => 'Zulia', 'iso' => 'VE-V'],
            ['state' => 'Distrito Capital', 'iso' => 'VE-A'],
            ['state' => 'Dependencias Federales', 'iso' => 'VE-Z']
        ];

        foreach ($states as $row) {
            App\State::create($row);
        }
    }
}
