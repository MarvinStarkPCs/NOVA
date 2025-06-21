<?php

namespace Database\Seeders;

use App\Models\Asignatura;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsignaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Asignatura::insert([
            ['nombre' => 'Matemáticas'],
            ['nombre' => 'Lengua Castellana'],
            ['nombre' => 'Ciencias Naturales'],
            ['nombre' => 'Arte'],
        ]);
    }
}
