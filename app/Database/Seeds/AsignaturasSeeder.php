<?php

// app/Database/Seeds/AsignaturasSeeder.php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AsignaturasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nombre' => 'Matemáticas'],
            ['nombre' => 'Lengua'],
            ['nombre' => 'Ciencias Naturales'],
            ['nombre' => 'Ciencias Sociales'],
        ];

        $this->db->table('asignaturas')->insertBatch($data);
    }
}
