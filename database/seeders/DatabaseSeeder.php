<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolSeeder::class,
            UsuarioSeeder::class,
            NegocioSeeder::class,
            EstablecimientoSeeder::class,
            StaffSeeder::class,
            ProductoSeeder::class,
            CategoriaSeeder::class,
            ServicioSeeder::class
        ]);
    }
}
