<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GradosSeeder extends Seeder
{
    public function run()
    {
        $grados = [
            'Primero',
            'Segundo',
            'Tercero',
            'Cuarto',
            'Quinto',
            'Sexto',
            'Séptimo',
            'Octavo',
            'Noveno',
            'Décimo',
            'Undécimo'
        ];

        foreach ($grados as $nombre) {
            $this->db->table('grados')->insert(['nombre' => $nombre]);
        }
    }
}
