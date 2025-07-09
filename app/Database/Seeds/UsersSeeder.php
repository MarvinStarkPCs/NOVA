<?php

// app/Database/Seeds/UsersSeeder.php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'login' => 'docente1',
                'name' => 'Admin',
                'email' => 'admin@docente.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'login' => 'estiante1',
                'name' => 'estudiante1',
                'email' => 'admin@estudiante.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
 