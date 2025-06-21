<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pregunta;

class PreguntaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Pregunta::create([
            'enunciado' => '¿Cuál es el estado líquido del agua?',
            'opcion_a' => 'Hielo',
            'opcion_b' => 'Vapor',
            'opcion_c' => 'Agua líquida',
            'opcion_d' => 'Niebla',
            'opcion_correcta' => 'C',
            'justificacion' => 'El agua líquida es su estado natural a temperatura ambiente.',
            'tipo' => 'opcion_multiple',
            'asignatura_id' => 3, // Ciencias Naturales
        ]);
    }
}
