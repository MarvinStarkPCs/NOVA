<?php

namespace App\Models;
use CodeIgniter\Model;
class MatriculaModel extends Model
{
    protected $table = 'matriculas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'grupo_id', 'jornada_id' , 'fecha_matricula'];
    protected $returnType = 'array';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getMatriculasByUserId($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }
}