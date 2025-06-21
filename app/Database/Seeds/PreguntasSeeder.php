<?php

// app/Database/Seeds/PreguntasSeeder.php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PreguntasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'enunciado' => '¿Qué parte de la célula contiene el material genético?',
                'opcion_a' => 'Citoplasma',
                'opcion_b' => 'Núcleo',
                'opcion_c' => 'Membrana',
                'opcion_d' => 'Pared celular',
                'opcion_correcta' => 'B',
                'justificacion' => 'El núcleo contiene el ADN de la célula.',
                'tipo' => 'Opción múltiple',
                'asignatura_id' => 3
            ]
        ];

        $this->db->table('preguntas')->insertBatch($data);
    }
}
