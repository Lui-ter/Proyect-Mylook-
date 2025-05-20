<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstablecimientoSeeder extends Seeder
{
    public function run(): void
    {
        // Registro de tres establecimientos

        DB::table('establecimiento')->insert([
            [
                'id_establc' => '65454812210',
                'id_negocio' => '12345678910',
                'nombre_establc' => 'Imperium Barber Shop',
                'desc_establc' => 'Establecimiento principal de Imperium Barber Shop, ubicado en el centro de la ciudad, cuenta con un ambiente sofisticado, moderno y un espacio cómodo para que cada cliente disfrute de una experiencia unica',
                'ubicacion' => 'Cra 55 # 64-20',
                'correo' => 'imperium@gmail.com',
                'telefono' => '3125547856',
                'valoracion_final' => '7'
            ]
        ]);

        DB::table('establecimiento')->insert([
            [
                'id_establc' => '74502224346',
                'id_negocio' => '10987654321',
                'nombre_establc' => 'Aura Spa',
                'desc_establc' => 'El establecimiento de Aura Spa ubicada en el sur, diseñada para brindar una experiencia de relajacion total, ofrecemos espacios privados, tratamientos exclusivos y un ambiente sereno con aromas naturales',
                'ubicacion' => 'Cll 22 # 54-44',
                'correo' => 'auraspa@hotmail.com',
                'telefono' => '3222158877',
                'valoracion_final' => '5'
            ]
        ]);

        DB::table('establecimiento')->insert([
            [
                'id_establc' => '64225155511',
                'id_negocio' => '10192837465',
                'nombre_establc' => 'Nailuxe',
                'desc_establc' => 'El establecimiento de Nailuxe, equipada con estaciones modernas para manicure y pedicure, diseñadas para ofrecer una experiencia personalizada en diseño de uñas y cuidados esteticos, en un ambiente comodo y profesional',
                'ubicacion' => 'Av 24 # 54-11',
                'correo' => 'nailuxe@outlock.com',
                'telefono' => '3305448844',
                'valoracion_final' => '9'
            ]
        ]);
    }
}
