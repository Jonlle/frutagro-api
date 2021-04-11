<?php

use Illuminate\Database\Seeder;

class SocialMediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $social_media = [
            ['icon_name' => 'fab fa-instagram', 'icon_size' => 'fa-3x', 'name' => 'instagram', 'url' => 'https://www.instagram.com/distribuidorafrutagro/', 'status_id' => 'en'],
            ['icon_name' => 'fab fa-facebook-f', 'icon_size' => 'fa-2x', 'name' => 'facebook'],
            ['icon_name' => 'fab fa-whatsapp', 'icon_size' => 'fa-2x', 'name' => 'whatsapp'],
            ['icon_name' => 'fab fa-telegram-plane', 'icon_size' => 'fa-3x', 'name' => 'telegram'],
            ['icon_name' => 'fab fa-youtube', 'icon_size' => 'fa-2x', 'name' => 'youtube'],
            ['icon_name' => 'fab fa-blogger-b', 'icon_size' => 'fa-3x', 'name' => 'blogger']
        ];

        foreach ($social_media as $row) {
            App\SocialMedia ::create($row);
        }
    }
}
