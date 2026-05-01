<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@agrivall.com'],
            [
                'name'     => 'Administrador Agrivall',
                'password' => bcrypt('agrivall2026'),
                'is_admin' => true,
            ]
        );

        $productos = [
            ['nombre' => 'Cerezas',      'formato' => '1 kg',  'precio' => 6.50],
            ['nombre' => 'Cerezas',      'formato' => '4 kg',  'precio' => 22.00],
            ['nombre' => 'Albaricoques', 'formato' => '1 kg',  'precio' => 4.25],
            ['nombre' => 'Albaricoques', 'formato' => '4 kg',  'precio' => 15.00],
            ['nombre' => 'Nueces',       'formato' => '1 kg',  'precio' => 8.75],
            ['nombre' => 'Nueces',       'formato' => '4 kg',  'precio' => 32.00],
        ];

        foreach ($productos as $datos) {
            Producto::firstOrCreate(
                ['nombre' => $datos['nombre'], 'formato' => $datos['formato']],
                ['precio' => $datos['precio'], 'disponible' => true]
            );
        }
    }
}
