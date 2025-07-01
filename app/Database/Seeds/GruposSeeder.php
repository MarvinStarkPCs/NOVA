<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GruposSeeder extends Seeder
{
    public function run()
    {
        $grupos = [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            '10'
                ];

        foreach ($grupos as $nombre) {
            $this->db->table('grupos')->insert(['nombre' => $nombre]);
        }
    }
}
