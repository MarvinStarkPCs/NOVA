<?php

// app/Database/Seeds/RolesSeeder.php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nombre' => 'Docente'],
    
            ['nombre' => 'Estudiante']    ,    ];

        $this->db->table('roles')->insertBatch($data);
    }
}
