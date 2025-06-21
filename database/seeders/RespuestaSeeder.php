<?php

namespace Database\Seeders;
use App\Models\Respuesta;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RespuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Respuesta::create([
            'user_id' => 1,
            'pregunta_id' => 1,
            'opcion_elegida' => 'C',
            'respuesta_correcta' => true,
        ]);
    }
}
