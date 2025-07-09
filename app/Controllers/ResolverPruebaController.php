<?php

namespace App\Controllers;

use App\Models\RespuestaModel;
use CodeIgniter\Controller;

class ResolverPruebaController extends BaseController
{
    public function mostrar()
    {
        $db = \Config\Database::connect();

        // Obtener lecturas y preguntas asociadas
        $lecturasRaw = $db->query("
            SELECT 
              l.id AS lectura_id,
              l.titulo AS lectura_titulo,
              l.contenido AS lectura_contenido,
              p.id AS pregunta_id,
              p.enunciado,
              p.opcion_a,
              p.opcion_b,
              p.opcion_c,
              p.opcion_d,
              p.opcion_correcta,
              p.justificacion,
              p.tipo
            FROM lecturas l
            JOIN lecturas_preguntas lp ON l.id = lp.lectura_id
            JOIN preguntas p ON lp.pregunta_id = p.id
        ")->getResultArray();

        // Agrupar por lectura
        $lecturasAgrupadas = [];

        foreach ($lecturasRaw as $row) {
            $id = $row['lectura_id'];

            if (!isset($lecturasAgrupadas[$id])) {
                $lecturasAgrupadas[$id] = [
                    'lectura_id' => $id,
                    'titulo' => $row['lectura_titulo'],
                    'contenido' => $row['lectura_contenido'],
                    'preguntas' => []
                ];
            }

            $lecturasAgrupadas[$id]['preguntas'][] = [
                'pregunta_id' => $row['pregunta_id'],
                'enunciado' => $row['enunciado'],
                'opcion_a' => $row['opcion_a'],
                'opcion_b' => $row['opcion_b'],
                'opcion_c' => $row['opcion_c'],
                'opcion_d' => $row['opcion_d'],
                'opcion_correcta' => $row['opcion_correcta'],
                'justificacion' => $row['justificacion'],
                'tipo' => $row['tipo']
            ];
        }

        // Preguntas sueltas (sin lectura)
        $preguntasSueltas = $db->query("
            SELECT * FROM preguntas
            WHERE id NOT IN (SELECT pregunta_id FROM lecturas_preguntas)
        ")->getResultArray();

        return view('system\ver_prueba', [
            'lecturas_con_preguntas' => array_values($lecturasAgrupadas),
            'preguntas_sueltas' => $preguntasSueltas
        ]);
    }

    public function guardarRespuestas()
    {
        $respuestas = $this->request->getPost('respuesta');
        $userId = session()->get('user_id'); // o asigna uno fijo si es prueba

        $respuestaModel = new RespuestaModel();

        foreach ($respuestas as $preguntaId => $opcionElegida) {
            // Verificar si es correcta
            $pregunta = db_connect()
                ->table('preguntas')
                ->select('opcion_correcta')
                ->where('id', $preguntaId)
                ->get()
                ->getRow();

            $esCorrecta = ($pregunta && $pregunta->opcion_correcta === $opcionElegida) ? 1 : 0;

            $respuestaModel->insert([
                'user_id' => $userId ?? 1, // valor fijo si no hay sesión
                'pregunta_id' => $preguntaId,
                'opcion_elegida' => $opcionElegida,
                'respuesta_correcta' => $esCorrecta,
                'fecha_respuesta' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->to('/resolver/mostrar')->with('success', 'Respuestas guardadas.');
    }
}
