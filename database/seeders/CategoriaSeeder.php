<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        // Registro de tres categorias una para cada establecimiento

        DB::table('categoria')->insert([
            [
                'id_establc' => '65454812210',
                'nom_categoria' => 'Cabello & Barba',
                'desc_categoria' => 'Servicios especializados en cortes modernos y clasicos para cabello, barba y cejas, diseñados para resaltar el estilo personal de cada cliente',
                'imagen' => file_get_contents(database_path('seeders/Imagenes/Img_categoria/img1.jpg'))
            ]
        ]);

        DB::table('categoria')->insert([
            [
                'id_establc' => '74502224346',
                'nom_categoria' => 'Masajes corporales',
                'desc_categoria' => 'Sesiones terapeuticas diseñadas para reducir el estrés, aliviar dolores musculares y proporcionar una relajacion profunda',
                'imagen' => file_get_contents(database_path('seeders/Imagenes/Img_categoria/img2.jpg'))
            ]
        ]);

        DB::table('categoria')->insert([
            [
                'id_establc' => '64225155511',
                'nom_categoria' => 'Diseño de uñas',
                'desc_categoria' => 'Servicios de aplicacion y diseño profesional de uñas acrílicas, gel y esculpidas, personalizadas al gusto de cada clienta',
                'imagen' => file_get_contents(database_path('seeders/Imagenes/Img_categoria/img3.jpg'))
            ]
        ]);
    }
}
