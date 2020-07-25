<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banners = [
            ['title' => 'Banner 1', 'title_color' => 'rgb(64, 73, 59)', 'description' => 'Banner 1 Description','description_color' => 'rgb(0, 0, 0)', 'file_image' => '3_banner.jpg', 'file_path' => '/images/banners'],
            ['title' => 'Banner 2', 'title_color' => 'rgba(64, 73, 59, 1)', 'description' => 'Banner 2 Description','description_color' => 'rgba(64, 73, 59, 1)', 'file_image' => '5_banner.jpg', 'file_path' => '/images/banners'],
        ];

        foreach ($banners as $row) {
            App\Banner::create($row);
        }

    }
}
