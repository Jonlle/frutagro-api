<?php

use Illuminate\Database\Seeder;

class InfoAboutUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $general_banners = [
            ['section' => 'aboutus', 'title' => 'Sobre nosotros', 'info_text' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sit, voluptatum quis dicta. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sit, voluptatum quis dicta. Lorem ipsum dolor, sit amet consectetur adipisicing', 'file_image' => '14_about_us.jpg'],
            ['section' => 'contact', 'title' => 'Contacto', 'info_text' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sit, voluptatum quis dicta. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sit, voluptatum quis dicta. Lorem ipsum dolor, sit amet consectetur adipisicing', 'file_image' => '56_contact.jpg'],
        ];

        foreach ($general_banners as $row) {
            App\Models\InfoAboutUs::create($row);
        }
    }
}
