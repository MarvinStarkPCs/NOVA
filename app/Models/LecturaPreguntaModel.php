<?php

namespace App\Models;

use CodeIgniter\Model;

class LecturaPreguntaModel extends Model
{
    protected $table = 'lecturas_preguntas';
    protected $primaryKey = null; // No tiene ID
    protected $allowedFields = ['lectura_id', 'pregunta_id'];
    protected $useTimestamps = false;
    public $incrementing = false;
}
