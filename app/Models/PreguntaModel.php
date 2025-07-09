<?php

namespace App\Models;

use CodeIgniter\Model;

class PreguntaModel extends Model
{
    protected $table = 'preguntas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'enunciado',
        'opcion_a',
        'opcion_b',
        'opcion_c',
        'opcion_d',
        'opcion_correcta',
        'justificacion',
        'tipo',
        'asignatura_id'
    ];
    protected $useTimestamps = false;
}
