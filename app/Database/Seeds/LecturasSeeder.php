<?php

// app/Database/Seeds/LecturasSeeder.php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LecturasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'titulo' => 'La célula: unidad de vida',
                'contenido' => 'Las células son las unidades básicas de los seres vivos...',
                'asignatura_id' => 3 // Ciencias Naturales
            ],
        ];

        $this->db->table('lecturas')->insertBatch($data);
    }
}
