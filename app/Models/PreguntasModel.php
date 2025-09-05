<?php 
namespace App\Models;
use CodeIgniter\Model;


class PreguntasModel extends Model
{
    protected $table      = 'preguntas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['enunciado', 'opcion_a', 'opcion_b', 'opcion_c', 'opcion_d', 'opcion_correcta', 'tipo', 'prueba_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}