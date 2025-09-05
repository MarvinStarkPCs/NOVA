<?php

namespace App\Models;

use CodeIgniter\Model;

class RespuestasModel extends Model
{
    protected $table      = 'respuestas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'estudiante_id',
        'pregunta_id',
        'prueba_id',
        'opcion_elegida',
        'respuesta_correcta',
        'fecha_respuesta'
    ];

    protected $useTimestamps = false;

    protected $returnType = 'array';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

     public function getRespuestasPorPrueba($idPrueba, $idEstudiante)
    {
        return $this->where('prueba_id', $idPrueba)
                    ->where('estudiante_id', $idEstudiante)
                    ->findAll();
    }


          public function obtenerPruebaCompleta($pruebaId, $estudianteId)
    {
        $sql = "
            SELECT 
                -- Información de la prueba
                p.id as prueba_id,
                p.nombre as prueba_nombre,
                p.descripcion as prueba_descripcion,
                p.created_at as prueba_fecha_creacion,
                
                -- Información del profesor
                up.name as profesor_nombre,
                up.last_name as profesor_apellido,
                
                -- Información de la asignatura
                a.nombre as asignatura,
                
                -- Información de las lecturas (si existen)
                l.id as lectura_id,
                l.titulo as lectura_titulo,
                l.contenido as lectura_contenido,
                
                -- Información de las preguntas
                pr.id as pregunta_id,
                pr.enunciado as pregunta_enunciado,
                pr.opcion_a,
                pr.opcion_b,
                pr.opcion_c,
                pr.opcion_d,
                pr.opcion_correcta,
                pr.justificacion,
                pr.tipo as pregunta_tipo,
                
                -- Información de las respuestas de estudiantes
                r.id as respuesta_id,
                r.opcion_elegida,
                r.respuesta_correcta as es_correcta,
                r.fecha_respuesta,
                
                -- Información del estudiante
                ue.name as estudiante_nombre,
                ue.last_name as estudiante_apellido,
                ue.documento as estudiante_documento,
                
                -- Información del grupo y grado
                g.nombre as grupo_nombre,
                gr.nombre as grado_nombre,
                j.nombre as jornada

            FROM pruebas p
                
                -- Join con profesor
                INNER JOIN users up ON p.profesor_id = up.id
                
                -- Join con asignatura
                INNER JOIN asignaturas a ON p.asignatura_id = a.id
                
                -- Join con preguntas
                LEFT JOIN preguntas pr ON p.id = pr.prueba_id
                
                -- Join con lecturas (opcional, solo si la pregunta tiene lectura asociada)
                LEFT JOIN lectura_preguntas lp ON pr.id = lp.pregunta_id
                LEFT JOIN lecturas l ON lp.lectura_id = l.id
                
                -- Join con respuestas de estudiantes
                LEFT JOIN respuestas r ON pr.id = r.pregunta_id AND p.id = r.prueba_id
                
                -- Join con información del estudiante
                LEFT JOIN users ue ON r.estudiante_id = ue.id
                
                -- Join para obtener información del grupo y grado del estudiante
                LEFT JOIN matriculas m ON ue.id = m.user_id
                LEFT JOIN grupos g ON m.grupo_id = g.id
                LEFT JOIN grados gr ON g.grado_id = gr.id
                LEFT JOIN jornadas j ON m.jornada_id = j.id

            WHERE p.id = ? AND ue.id = ?

            ORDER BY pr.id
        ";
        
        return $this->db->query($sql, [$pruebaId, $estudianteId])->getResultArray();
    }
  
}
