<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        // Registro de los roles que maneja el staff en mylook

        DB::table('rol')->insert([
            ['nombre_rol' => 'Administrador'],
            ['nombre_rol' => 'Peluquero'],
            ['nombre_rol' => 'Barbero'],
            ['nombre_rol' => 'Manicurista'],
            ['nombre_rol' => 'Pedicurista'],
            ['nombre_rol' => 'Estilista'],
        ]);
    }
}
