<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Aquí llamas tus otros seeders
        $this->call([
            RoleSeeder::class,
            AsignaturaSeeder::class,
            UserSeeder::class,
            PreguntaSeeder::class,
            LecturaSeeder::class,
            LecturaPreguntaSeeder::class,
            RespuestaSeeder::class,
        ]);
    }
}
