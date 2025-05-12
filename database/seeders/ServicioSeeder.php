<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ServicioSeeder extends Seeder
{
    public function run(): void
    {
        // Registro de 9 servicios, 3 para cada categoria

        DB::table('servicio')->insert([
            [
                'id_categoria' => '1',
                'nombre_servicio' => 'Corte de cabello',
                'desc_servicio' => 'Corte de cabello personalizado según el estilo deseado, adaptado a las características del cliente',
                'duracion_serv' => '60',
                'precio_servicio' => '15000'
            ]
        ]);

        DB::table('servicio')->insert([
            [
                'id_categoria' => '1',
                'nombre_servicio' => 'Corte de barba',
                'desc_servicio' => 'Corte y modelado de barba con contorno preciso y estilizado',
                'duracion_serv' => '30',
                'precio_servicio' => '4000'
            ]
        ]);

        DB::table('servicio')->insert([
            [
                'id_categoria' => '1',
                'nombre_servicio' => 'Perfilado de cejas',
                'desc_servicio' => 'Perfilado y limpieza de cejas, adaptado al tipo de rostro',
                'duracion_serv' => '15',
                'precio_servicio' => '3000'
            ]
        ]);

        DB::table('servicio')->insert([
            [
                'id_categoria' => '2',
                'nombre_servicio' => 'Masaje',
                'desc_servicio' => 'Masaje relajante que ayuda a liberar tensiones y mejora la circulación sanguínea',
                'duracion_serv' => '60',
                'precio_servicio' => '30000'
            ]
        ]);

        DB::table('servicio')->insert([
            [
                'id_categoria' => '2',
                'nombre_servicio' => 'Exfoliación',
                'desc_servicio' => 'Exfoliación corporal con productos naturales para revitalizar la piel',
                'duracion_serv' => '40',
                'precio_servicio' => '30000'
            ]
        ]);

        DB::table('servicio')->insert([
            [
                'id_categoria' => '2',
                'nombre_servicio' => 'Mascarillas',
                'desc_servicio' => 'Mascarillas faciales rejuvenecedoras que hidratan y nutren la piel',
                'duracion_serv' => '30',
                'precio_servicio' => '18000'
            ]
        ]);

        DB::table('servicio')->insert([
            [
                'id_categoria' => '3',
                'nombre_servicio' => 'Manicure',
                'desc_servicio' => 'Cuidado completo de las uñas de las manos, con limado y esmaltado de alta calidad',
                'duracion_serv' => '40',
                'precio_servicio' => '20000'
            ]
        ]);

        DB::table('servicio')->insert([
            [
                'id_categoria' => '3',
                'nombre_servicio' => 'Pedicure',
                'desc_servicio' => 'Tratamiento completo para las uñas de los pies, incluyendo limpieza, corte y esmaltado',
                'duracion_serv' => '45',
                'precio_servicio' => '25000'
            ]
        ]);

        DB::table('servicio')->insert([
            [
                'id_categoria' => '3',
                'nombre_servicio' => 'Diseño',
                'desc_servicio' => 'Diseño personalizado de uñas con tecnicas de arte en gel, acrilico y decoracion exclusiva',
                'duracion_serv' => '60',
                'precio_servicio' => '35000'
            ]
        ]);
    }
}
