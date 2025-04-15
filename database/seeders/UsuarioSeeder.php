<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        // Registro de usuarios que tendran el rol administrador

        DB::table('usuario')->insert([
            [
                'id_usuario' => '1222544457',
                'nombre' => 'Rodrigo',
                'apellido' => 'Perez',
                'correo' => 'rodrigoperez@outlook.com',
                'contrasena' => Hash::make('Mylook012'),
                'telefono' => '3012245588',
                'img_usuario' => file_get_contents(database_path('seeders/Imagenes/Img_usuario/usuario1.jpg')),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('usuario')->insert([
            [
                'id_usuario' => '4455887774',
                'nombre' => 'Santiago',
                'apellido' => 'Sepulveda',
                'correo' => 'santiagosepulveda@gmail.com',
                'contrasena' => Hash::make('Mylook012'),
                'telefono' => '3262258844',
                'img_usuario' => file_get_contents(database_path('seeders/Imagenes/Img_usuario/usuario2.jpg')),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('usuario')->insert([
            [
                'id_usuario' => '6525544110',
                'nombre' => 'Jose',
                'apellido' => 'Rodriguez',
                'correo' => 'joserodriguez@yahoo.com',
                'contrasena' => Hash::make('Mylook012'),
                'telefono' => '3358772387',
                'img_usuario' => file_get_contents(database_path('seeders/Imagenes/Img_usuario/usuario3.jpg')),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Registro de usuario que tendra cualquier rol de staff que no sea administrador

        DB::table('usuario')->insert([
            [
                'id_usuario' => '2654488745',
                'nombre' => 'Oscar',
                'apellido' => 'Hernandez',
                'correo' => 'oscarhernandez@gmail.com',
                'contrasena' => Hash::make('Mylook012'),
                'telefono' => '3135544875',
                'img_usuario' => file_get_contents(database_path('seeders/Imagenes/Img_usuario/usuario4.jpg')),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('usuario')->insert([
            [
                'id_usuario' => '9555544122',
                'nombre' => 'Ramiro',
                'apellido' => 'Cordoba',
                'correo' => 'ramirocordoba@gmail.com',
                'contrasena' => Hash::make('Mylook012'),
                'telefono' => '3134587755',
                'img_usuario' => file_get_contents(database_path('seeders/Imagenes/Img_usuario/usuario5.jpg')),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('usuario')->insert([
            [
                'id_usuario' => '7845489996',
                'nombre' => 'Maria',
                'apellido' => 'Orozco',
                'correo' => 'mariaorozco@gmail.com',
                'contrasena' => Hash::make('Mylook012'),
                'telefono' => '3154447788',
                'img_usuario' => file_get_contents(database_path('seeders/Imagenes/Img_usuario/usuario6.jpg')),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Registro de usuario que no tiene rol alguno

        DB::table('usuario')->insert([
            [
                'id_usuario' => '9844512154',
                'nombre' => 'Manuel',
                'apellido' => 'Restrepo',
                'correo' => 'manuelrestrepo@hotmail.com',
                'contrasena' => Hash::make('Mylook012'),
                'telefono' => '3255457780',
                'img_usuario' => file_get_contents(database_path('seeders/Imagenes/Img_usuario/usuario7.jpg')),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
