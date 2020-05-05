<?php

use Illuminate\Database\Seeder;

class DocumentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doc_types = [
            ['id' => 'ci', 'status_id' => 'a', 'description' => 'Cédula de identidad'],
            ['id' => 'rif', 'status_id' => 'a', 'description' => 'RIF'],
            ['id' => 'p', 'status_id' => 'a', 'description' => 'Pasaporte']
        ];

        foreach ($doc_types as $row) {
            App\DocumentType::create($row);
        }
    }
}
