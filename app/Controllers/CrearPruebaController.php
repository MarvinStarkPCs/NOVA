<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use Faker\Provider\Base;

class CrearPruebaController extends BaseController
{
    public function index()
    {
       
        return view('system\crearprueba');
    }

public function guardar()
{
    try {
        $jsonData = $this->request->getJSON(true); // ✅ Lee el JSON como array asociativo

        if (!$jsonData || !isset($jsonData['asignatura_id']) || !isset($jsonData['bloques'])) {
            return $this->response->setJSON(['error' => 'Datos incompletos'])->setStatusCode(400);
        }

        $asignatura_id = $jsonData['asignatura_id'];
        $bloques = $jsonData['bloques'];

        $db = \Config\Database::connect();
        $db->transStart(); // 🌀 Inicia transacción

        foreach ($bloques as $bloque) {
            $tipo = $bloque['tipo'];
            $preguntas = $bloque['preguntas'];

            // Si es un bloque con texto, se guarda como lectura
            if ($tipo === 'con-texto') {
                $titulo = $bloque['titulo'];
                $texto = $bloque['texto'];

                $db->table('lecturas')->insert([
                    'titulo' => $titulo,
                    'contenido' => $texto,
                    'asignatura_id' => $asignatura_id
                ]);
                $lectura_id = $db->insertID();
            }

            foreach ($preguntas as $pregunta) {
                $enunciado = $pregunta['enunciado'];
                $opciones = $pregunta['opciones']; // [A, B, C, D]
                $correcta = $pregunta['correcta']; // "A", "B", etc.
                $justificacion = $pregunta['justificacion'];

                $db->table('preguntas')->insert([
                    'enunciado'       => $enunciado,
                    'opcion_a'        => $opciones[0],
                    'opcion_b'        => $opciones[1],
                    'opcion_c'        => $opciones[2],
                    'opcion_d'        => $opciones[3],
                    'opcion_correcta' => $correcta,
                    'justificacion'   => $justificacion,
                    'tipo'            => $tipo,
                    'asignatura_id'   => $asignatura_id
                ]);
                $pregunta_id = $db->insertID();

                // Si hay lectura, se relaciona con la pregunta
                if ($tipo === 'con-texto') {
                    $db->table('lecturas_preguntas')->insert([
                        'lectura_id'  => $lectura_id,
                        'pregunta_id' => $pregunta_id
                    ]);
                }
            }
        }

        $db->transComplete(); // ✅ Ejecuta la transacción

        if ($db->transStatus() === false) {
            return $this->response->setJSON(['error' => 'Error al guardar en la base de datos'])->setStatusCode(500);
        }

        return $this->response->setJSON(['message' => 'Prueba guardada exitosamente']);
    } catch (\Throwable $e) {
        return $this->response->setJSON([
            'error' => 'Error inesperado',
            'details' => $e->getMessage()
        ])->setStatusCode(500);
    }
}


}