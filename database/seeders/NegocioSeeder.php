<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class NegocioSeeder extends Seeder
{
    public function run(): void
    {
        // Registro de los tres negocios

        DB::table('negocio')->insert([
            [
                'id_negocio' => '12345678910',
                'id_usuario' => '1222544457',
                'nombre_negocio' => 'Imperium Barber Shop',
                'desc_negocio' => 'Barbería moderna y elegante, especializada en cortes de cabello clásicos, arreglos de barba y diseño de cejas. Ofrecemos un servicio personalizado de alta calidad en un ambiente cómodo y exclusivo para caballeros',
                'contrasena' => Hash::make('Imperium01'),
                'img_perfil' => file_get_contents(database_path('seeders/Imagenes/Img_negocio/img1.jpg')),
                'img_portada' => file_get_contents(database_path('seeders/Imagenes/Img_negocio/img2.jpg')),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('negocio')->insert([
            [
                'id_negocio' => '10987654321',
                'id_usuario' => '4455887774',
                'nombre_negocio' => 'Aura Spa',
                'desc_negocio' => 'Centro de bienestar integral que ofrece masajes, relajación profunda y terapias. Nuestro ambiente tranquilo y relajante, junto con productos naturales, garantizan una experiencia única de rejuvenecimiento',
                'contrasena' => Hash::make('Auraspa01'),
                'img_perfil' => file_get_contents(database_path('seeders/Imagenes/Img_negocio/img3.jpg')),
                'img_portada' => file_get_contents(database_path('seeders/Imagenes/Img_negocio/img4.jpg')),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('negocio')->insert([
            [
                'id_negocio' => '10192837465',
                'id_usuario' => '6525544110',
                'nombre_negocio' => 'Nailuxe Studio',
                'desc_negocio' => 'Estudio de uñas profesional dedicado al cuidado y diseño de uñas. Ofrecemos servicios de manicure, pedicure, uñas acrílicas, gel semipermanente y nail art, con atención personalizada y un ambiente higiénico y moderno',
                'contrasena' => Hash::make('Nailuxe01'),
                'img_perfil' => file_get_contents(database_path('seeders/Imagenes/Img_negocio/img5.jpg')),
                'img_portada' => file_get_contents(database_path('seeders/Imagenes/Img_negocio/img6.jpg')),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
