<?php

// app/Database/Seeds/DatabaseSeeder.php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('RolesSeeder');
        $this->call('AsignaturasSeeder');
        $this->call('UsersSeeder');
        $this->call('LecturasSeeder');
        $this->call('PreguntasSeeder');
        $this->call('LecturasPreguntasSeeder');
        $this->call('RespuestasSeeder');
        $this->call('GradosSeeder');
        $this->call('GruposSeeder');
    }
}
