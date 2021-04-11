<?php

use Illuminate\Database\Seeder;

class GeneralBannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $general_banners = [
            ['section' => 'Inicio', 'title' => 'Banner mediano', 'slug' => 'dashboard-medium', 'file_image' => '423_banner_general.jpg'],
            ['section' => 'Inicio', 'title' => 'Banner mediano', 'slug' => 'dashboard-medium', 'file_image' => '898_banner_general.jpg'],
            ['section' => 'Categorías', 'title' => 'Banner completo', 'slug' => 'category-full', 'file_image' => '579_banner_general.jpg'],
            ['section' => 'Categorías', 'title' => 'Banner vertical', 'slug' => 'category-vertical', 'file_image' => '157_banner_general.jpg'],
            ['section' => 'Carrito', 'title' => 'Banner vertical', 'slug' => 'cart-vertical', 'file_image' => '368_banner_general.jpg'],
            ['section' => 'Caja', 'title' => 'Banner vertical', 'slug' => 'checkout-vertical', 'file_image' => '985_banner_general.jpg'],
            ['section' => 'Busqueda', 'title' => 'Banner vertical', 'slug' => 'search-vertical', 'file_image' => '756_banner_general.jpg'],
        ];

        foreach ($general_banners as $row) {
            App\Models\GeneralBanner::create($row);
        }
    }
}
