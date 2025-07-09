<?php

namespace App\Models;

use CodeIgniter\Model;

class PruebaModel extends Model
{
    protected $table            = 'pruebas';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'asignatura_id',
        'user_id',
        'nombre',
        'descripcion',
        'created_at',
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $returnType       = 'array';
}
