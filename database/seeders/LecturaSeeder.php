<?php

namespace Database\Seeders;
use App\Models\Lectura;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LecturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lectura::create([
            'titulo' => 'La importancia del agua',
            'contenido' => 'El agua es vital para los seres vivos...',
            'asignatura_id' => 3, // Ciencias Naturales
        ]);
    }
}
