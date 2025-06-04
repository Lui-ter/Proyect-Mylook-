<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        // Registro de productos

        DB::table('producto')->insert([
            [
                'id_establc' => '12345678910',
                'nombre_prod' => 'Gel para pelo',
                'nom_marca' => 'Ego',
                'desc_prod' => 'Te permite lograr un peinado con ultra fijación, para que nada te despeine, máxima duración hasta por 24 horas y una fragancia intensa premium y masculina',
                'stock' => '20',
                'valor_prod' => '20000',
                'img_prod' => file_get_contents(database_path('seeders/Imagenes/Img_producto/img1.jpg')),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('producto')->insert([
            [
                'id_establc' => '10987654321',
                'nombre_prod' => 'Crema para masajes',
                'nom_marca' => 'Natura',
                'desc_prod' => 'Piel suave y protegida, fácil de aplicar, rápida absorción. Acción prebiótica que mantiene el equilibrio natural de la piel',
                'stock' => '20',
                'valor_prod' => '26000',
                'img_prod' => file_get_contents(database_path('seeders/Imagenes/Img_producto/img2.jpg')),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('producto')->insert([
            [
                'id_establc' => '10192837465',
                'nombre_prod' => 'Esmalte para uñas',
                'nom_marca' => 'Masglo',
                'desc_prod' => 'El esmalte de uñas de poligel es una de las opciones de esmalte más duraderas. Puede durar hasta 21 días con un mantenimiento adecuado',
                'stock' => '20',
                'valor_prod' => '22500',
                'img_prod' => file_get_contents(database_path('seeders/Imagenes/Img_categoria/img3.jpg')),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
