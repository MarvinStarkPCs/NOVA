<?php 
namespace App\Models;

class PruebasMatriculaModel extends \CodeIgniter\Model
{
    protected $table            = 'prueba_matriculas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'prueba_id',
        'matricula_id',
        'fecha_asignacion',
        'fecha_limite',
        'estado', // e.g., 'asignada', 'completada'
        'calificacion'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Obtener las asignaciones de pruebas para un estudiante específico.
     *
     * @param int $matricula_id
     * @return array
     */
    public function getPruebasByMatricula($matricula_id)
    {
        return $this->db->table($this->table . ' pm')
            ->select('pm.*, p.nombre as nombre_prueba, p.descripcion, p.asignatura_id, a.nombre as asignatura')
            ->join('pruebas p', 'pm.prueba_id = p.id')
            ->join('asignaturas a', 'p.asignatura_id = a.id')
            ->where('pm.matricula_id', $matricula_id)
            ->orderBy('pm.fecha_asignacion', 'DESC')
            ->get()
            ->getResultArray();
    }
}