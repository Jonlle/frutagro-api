<?php

use Illuminate\Database\Seeder;

class InformationTextsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $information_texts = [
            ['section_name' => 'login', 'information_text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit consectetur animi cumque, asperiores iste dolorem fuga suscipit aperiam ab itaque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit consectetur animi cumque, asperiores iste'],
            ['section_name' => 'register', 'information_text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit consectetur animi cumque, asperiores iste dolorem fuga suscipit aperiam ab itaque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit consectetur animi cumque, asperiores iste'],
            ['section_name' => 'recover_password', 'information_text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit consectetur animi cumque, asperiores iste dolorem fuga suscipit aperiam ab itaque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit consectetur animi cumque, asperiores iste']
        ];

        foreach ($information_texts as $row) {
            App\Models\InformationText::create($row);
        }
    }
}
