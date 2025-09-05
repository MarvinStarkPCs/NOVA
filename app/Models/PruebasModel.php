<?php

namespace App\Models;

use CodeIgniter\Model;

class PruebasModel extends Model
{
    protected $table            = 'pruebas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; // o 'object' si prefieres objetos
    protected $allowedFields    = [
        'nombre',
        'descripcion',
        'asignatura_id',
        'profesor_id',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Obtener todas las pruebas creadas por un profesor.
     *
     * @param int $profesor_id
     * @return array
     */
    public function getPruebasByProfesor($profesor_id)
    {
        
        return $this->db->table($this->table . ' p')
            ->select('p.id as prueba_id, p.nombre as nombre_prueba, p.descripcion, a.nombre as asignatura, p.created_at as fecha_creacion')
            ->join('asignaturas a', 'p.asignatura_id = a.id')
            ->where('p.profesor_id', $profesor_id)
            ->orderBy('p.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }

public function getDetallePruebasPorGrupo($grupoId)
    {
        return $this->db->table('pruebas p')
            ->select("
                g.id as grupo_id,
                g.nombre as grupo,
                gra.nombre as grado,
                j.nombre as jornada,

                p.id as prueba_id,
                p.nombre as prueba_nombre,
                p.descripcion as prueba_descripcion,
                a.nombre as asignatura,

                CONCAT(u.name, ' ', u.last_name) as profesor,
                u.email as email_profesor,

                pg.fecha_asignacion,
                pg.fecha_limite,
                CASE 
                    WHEN pg.fecha_limite < NOW() THEN 'VENCIDA'
                    ELSE 'ACTIVA'
                END as estado_prueba,

                (SELECT COUNT(*) FROM preguntas pr WHERE pr.prueba_id = p.id) as total_preguntas,
                (SELECT COUNT(*) FROM lecturas l WHERE l.prueba_id = p.id) as total_lecturas,

                COUNT(DISTINCT m.user_id) as total_estudiantes_grupo,
                COUNT(DISTINCT r.estudiante_id) as estudiantes_participaron,
                ROUND(
                    CASE 
                        WHEN COUNT(DISTINCT m.user_id) > 0 THEN
                            (COUNT(DISTINCT r.estudiante_id) * 100.0 / COUNT(DISTINCT m.user_id))
                        ELSE 0 
                    END, 2
                ) as porcentaje_participacion
            ", false)
            ->join('prueba_grupos pg', 'p.id = pg.prueba_id')
            ->join('grupos g', 'pg.grupo_id = g.id')
            ->join('matriculas m', 'g.id = m.grupo_id')
            ->join('grados gra', 'g.grado_id = gra.id')
            ->join('jornadas j', 'm.jornada_id = j.id')
            ->join('asignaturas a', 'p.asignatura_id = a.id')
            ->join('users u', 'p.profesor_id = u.id')
            ->join('preguntas pr', 'p.id = pr.prueba_id', 'left')
            ->join('respuestas r', 'pr.id = r.pregunta_id AND r.estudiante_id = m.user_id', 'left')
            ->where('g.id', $grupoId)
            ->groupBy("
                g.id, g.nombre, gra.nombre, j.nombre,
                p.id, p.nombre, p.descripcion, a.nombre,
                u.name, u.last_name, u.email,
                pg.fecha_asignacion, pg.fecha_limite
            ", false)
            ->orderBy('pg.fecha_asignacion', 'DESC')
            ->get()
            ->getResultArray();
    }


public function getLecturasConPreguntas($pruebaId)
{
    $query = $this->db->query("
        SELECT l.id AS lectura_id, l.titulo, l.contenido,
               p.id AS pregunta_id, p.enunciado,
               p.opcion_a, p.opcion_b, p.opcion_c, p.opcion_d,
               p.opcion_correcta,
            p.justificacion
        FROM lecturas l
        LEFT JOIN lectura_preguntas lp ON l.id = lp.lectura_id
        LEFT JOIN preguntas p ON lp.pregunta_id = p.id
        WHERE l.prueba_id = ?
        ORDER BY l.id, p.id
    ", [$pruebaId]);

    $lecturas_raw = $query->getResultArray();
    $lecturas_con_preguntas = [];

    foreach ($lecturas_raw as $row) {
        $lecturaId = $row['lectura_id'];
        $lecturas_con_preguntas[$lecturaId]['titulo']    = $row['titulo'];
        $lecturas_con_preguntas[$lecturaId]['contenido'] = $row['contenido'];

        if (!empty($row['pregunta_id'])) {
            $lecturas_con_preguntas[$lecturaId]['preguntas'][] = [
                'pregunta_id'     => $row['pregunta_id'],
                'enunciado'       => $row['enunciado'],
                'opcion_a'        => $row['opcion_a'],
                'opcion_b'        => $row['opcion_b'],
                'opcion_c'        => $row['opcion_c'],
                'opcion_d'        => $row['opcion_d'],
                'opcion_correcta' => $row['opcion_correcta'], // ✅ correcto
                'justificacion'   => $row['justificacion'],
            ];
        }
    }
    return $lecturas_con_preguntas;
}

// 🔹 Preguntas sueltas
public function getPreguntasSueltas($pruebaId)
{
    $query = $this->db->query("
        SELECT p.id, p.enunciado,
               p.opcion_a, p.opcion_b, p.opcion_c, p.opcion_d,
               p.opcion_correcta,
               p.justificacion

        FROM preguntas p
        WHERE p.prueba_id = ?
          AND p.id NOT IN (SELECT pregunta_id FROM lectura_preguntas)
        ORDER BY p.id
    ", [$pruebaId]);

    return $query->getResultArray();
}



}
