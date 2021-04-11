<?php

use Illuminate\Database\Seeder;

class OurServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            ['icon_name' => 'fas fa-shopping-cart', 'service_name' => 'Mejores precios y ofertas', 'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.'],
            ['icon_name' => 'fas fa-globe-americas', 'service_name' => 'Surtido amplio', 'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text eve.'],
            ['icon_name' => 'fas fa-sync-alt', 'service_name' => 'Devoluciones fáciles', 'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using.'],
            ['icon_name' => 'fas fa-truck', 'service_name' => 'Entrega gratuita', 'description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.'],
            ['icon_name' => 'fas fa-shopping-basket', 'service_name' => 'Garantía de satisfacción del 100%', 'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.'],
            ['icon_name' => 'fas fa-heart', 'service_name' => 'Grandes ofertas diarias de descuento', 'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using.'],
        ];

        foreach ($services as $row) {
            App\Models\OurService::create($row);
        }
    }
}
