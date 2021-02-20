<?php

use Illuminate\Database\Seeder;

class LogoFaviconTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logo_favicon = [
            ['info_name' => 'logo', 'file_image' => 'logo_distribuidora_frutagro.png', 'file_path' => '/images/logo'],
            ['info_name' => 'favicon', 'file_image' => 'favicon_distribuidora_frutagro.png', 'file_path' => '/images/favicon']
        ];

        foreach ($logo_favicon as $row) {
            App\LogoFavicon ::create($row);
        }
    }
}
