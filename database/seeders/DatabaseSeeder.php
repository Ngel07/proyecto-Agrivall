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
                'password' => 'agrivall2026',
                'is_admin' => true,
            ]
        );

        $productos = [
            ['nombre' => 'Cerezas',      'formato' => '1 kg',  'precio' => 6.50,  'imagen' => 'images/cerezas1K.png'],
            ['nombre' => 'Cerezas',      'formato' => '4 kg',  'precio' => 22.00, 'imagen' => 'images/cerezas4K.png'],
            ['nombre' => 'Albaricoques', 'formato' => '1 kg',  'precio' => 4.25,  'imagen' => 'images/albaricoque1K.png'],
            ['nombre' => 'Albaricoques', 'formato' => '4 kg',  'precio' => 15.00, 'imagen' => 'images/albaricoque4K.png'],
            ['nombre' => 'Nueces',       'formato' => '1 kg',  'precio' => 8.75,  'imagen' => 'images/nueces1K.png'],
            ['nombre' => 'Nueces',       'formato' => '4 kg',  'precio' => 32.00, 'imagen' => 'images/nueces4k.png'],
            ['nombre' => 'Hierbas',      'formato' => '1 kg',  'precio' => 5.50,  'imagen' => 'images/hierbas.png'],
        ];

        foreach ($productos as $datos) {
            Producto::updateOrCreate(
                ['nombre' => $datos['nombre'], 'formato' => $datos['formato']],
                ['precio' => $datos['precio'], 'imagen' => $datos['imagen'], 'disponible' => true]
            );
        }
    }
}
