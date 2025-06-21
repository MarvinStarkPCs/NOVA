<?php

// app/Database/Seeds/RespuestasSeeder.php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RespuestasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 1,
                'pregunta_id' => 1,
                'opcion_elegida' => 'B',
                'respuesta_correcta' => true,
            ],
        ];

        $this->db->table('respuestas')->insertBatch($data);
    }
}
