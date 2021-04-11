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
            ['section_name' => 'recover_password', 'information_text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit consectetur animi cumque, asperiores iste dolorem fuga suscipit aperiam ab itaque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit consectetur animi cumque, asperiores iste'],
            ['section_name' => 'mission', 'information_text' => 'Investiga tiones demonstr averunt lectres legere melius quodqua legunt saepius. Clarias kest etiam pro cessus dynamicus squitur mutaety tion em consum etudium. Investig ationes demons trave huerunt lectores legere liusry. Investiga tiones demonstr averunt.'],
            ['section_name' => 'vision', 'information_text' => 'Investiga tiones demonstr averunt lectres legere melius quodqua legunt saepius. Clarias kest etiam pro cessus dynamicus squitur mutaety tion em consum etudium. Investig ationes demons trave huerunt lectores legere liusry. Investiga tiones demonstr averunt.']
        ];

        foreach ($information_texts as $row) {
            App\Models\InformationText::create($row);
        }

        $mission_vission_tags = [
            ['info_text' => 4, 'tags' => [1, 2, 3, 4]],
            ['info_text' => 5, 'tags' => [1, 2, 3, 4]]
        ];

        foreach ($mission_vission_tags as $row) {
            $mission_vission = App\Models\InformationText::find($row['info_text']);
            $mission_vission->tags()->attach($row['tags']);
        }
    }
}
