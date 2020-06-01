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
            ['id' => 'V', 'status_id' => 'ac', 'description' => 'Venezolano'],
            ['id' => 'E', 'status_id' => 'ac', 'description' => 'Extranjero'],
            ['id' => 'P', 'status_id' => 'ac', 'description' => 'Pasaporte'],
            ['id' => 'J', 'status_id' => 'ac', 'description' => 'Rif Jurídico'],
            ['id' => 'G', 'status_id' => 'ac', 'description' => 'Rif Gobierno'],
        ];

        foreach ($doc_types as $row) {
            App\DocumentType::create($row);
        }
    }
}
