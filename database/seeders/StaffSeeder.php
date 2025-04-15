<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        // Registros de Staff (admin y empleado)

        DB::table('staff')->insert([
            [
                'id_usuario' => '1222544457',
                'id_rol' => '1',
                'id_establc' => '12345678910',
                'id_negocio' => '12345678910',
                'estado' => ''
            ]
        ]);

        DB::table('staff')->insert([
            [
                'id_usuario' => '2654488745',
                'id_rol' => '2',
                'id_establc' => '12345678910',
                'id_negocio' => '12345678910',
                'estado' => 'disponible'
            ]
        ]);

        DB::table('staff')->insert([
            [
                'id_usuario' => '4455887774',
                'id_rol' => '1',
                'id_establc' => '10987654321',
                'id_negocio' => '10987654321',
                'estado' => ''
            ]
        ]);

        DB::table('staff')->insert([
            [
                'id_usuario' => '9555544122',
                'id_rol' => '6',
                'id_establc' => '10987654321',
                'id_negocio' => '10987654321',
                'estado' => 'disponible'
            ]
        ]);

        DB::table('staff')->insert([
            [
                'id_usuario' => '6525544110',
                'id_rol' => '1',
                'id_establc' => '10192837465',
                'id_negocio' => '10192837465',
                'estado' => ''
            ]
        ]);

        DB::table('staff')->insert([
            [
                'id_usuario' => '7845489996',
                'id_rol' => '4',
                'id_establc' => '10192837465',
                'id_negocio' => '10192837465',
                'estado' => 'disponible'
            ]
        ]);
    }
}
