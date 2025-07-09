<?php

namespace App\Models;

use CodeIgniter\Model;

class LecturaModel extends Model
{
    protected $table = 'lecturas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['titulo', 'contenido', 'asignatura_id'];
    protected $useTimestamps = false;
}
