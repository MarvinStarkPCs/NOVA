<?php 
namespace App\Models;

class PruebaGruposModel extends \CodeIgniter\Model
{
    protected $table            = 'prueba_grupos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'prueba_id',
        'grupo_id',
        'fecha_asignacion',
        'fecha_limite',
        'estado', // e.g., 'asignada', 'completada'
        'calificacion'
    ];

    protected $useTimestamps = true;
 

    /**
     * Obtener las asignaciones de pruebas para un estudiante específico.
     *
     * @param int $matricula_id
     * @return array
     */
    public function getPruebasByMatricula($matricula_id)
    {
     return $this->db->table('prueba_grupos pg')
    ->select('pg.*, p.nombre as nombre_prueba, p.descripcion, p.asignatura_id, a.nombre as asignatura, m.user_id as estudiante_id')
    ->join('pruebas p', 'pg.prueba_id = p.id')
    ->join('asignaturas a', 'p.asignatura_id = a.id')
    ->join('matriculas m', 'pg.grupo_id = m.grupo_id')
    ->where('m.id', $matricula_id)
    ->orderBy('pg.fecha_asignacion', 'DESC')
    ->get()
    ->getResultArray();
    }
}