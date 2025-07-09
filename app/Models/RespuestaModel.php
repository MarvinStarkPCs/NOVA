<?php

namespace App\Models;

use CodeIgniter\Model;

class RespuestaModel extends Model
{
    protected $table      = 'respuestas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'user_id',
        'pregunta_id',
        'opcion_elegida',
        'respuesta_correcta',
        'fecha_respuesta'
    ];

    protected $useTimestamps = false;

    protected $returnType = 'array';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
