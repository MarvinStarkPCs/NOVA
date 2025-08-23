<?php

namespace App\Models;
use CodeIgniter\Model;

class ProfesorAsignaturasModel extends Model
{

    protected $table = 'profesor_asignaturas';
    protected $primaryKey = 'id';   

    protected $allowedFields = ['profesor_id', 'asignatura_id'];

 protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
        
public function getAsignaturasByProfesor($profesor_id)
{
    return $this->db->table('profesor_asignaturas pa')
        ->select('a.id, a.nombre')
        ->join('asignaturas a', 'a.id = pa.asignatura_id')
        ->join('users u', 'u.id = pa.profesor_id')
        ->where('u.id', $profesor_id)
        ->get()
        ->getResultArray();
}




}