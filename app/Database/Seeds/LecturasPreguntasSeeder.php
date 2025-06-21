<?php


// app/Database/Seeds/LecturasPreguntasSeeder.php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LecturasPreguntasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['lectura_id' => 1, 'pregunta_id' => 1],
        ];

        $this->db->table('lecturas_preguntas')->insertBatch($data);
    }
}
