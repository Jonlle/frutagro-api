<?php

use Illuminate\Database\Seeder;

class CarouselBannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banners = [
            ['title' => 'Banner 1', 'description' => 'Banner 1 Description', 'file_image' => '3_banner.jpg'],
            ['title' => 'Banner 2', 'description' => 'Banner 2 Description', 'file_image' => '5_banner.jpg'],
        ];

        foreach ($banners as $row) {
            App\CarouselBanner::create($row);
        }

    }
}
