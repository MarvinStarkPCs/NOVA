<?php

namespace App\Controllers;

use App\Models\PruebasModel;
use CodeIgniter\Controller;
use App\Models\MatriculaModel;
use App\Models\RespuestasModel;
use App\Models\PreguntasModel;

class EstudianteController extends BaseController
{

    public function index() 
{
    // Modelos
    $matriculaModel = new MatriculaModel();
    $pruebaModel    = new PruebasModel();
    $respuestaModel = new RespuestasModel();

    // ID del estudiante logueado
    $estudianteId = session()->get('id_user');

    // 1. Consultar todas las matrículas del estudiante
    $matriculas = $matriculaModel
        ->select('grupo_id')
        ->where('user_id', $estudianteId)
        ->findAll();

    if (empty($matriculas)) {
        return redirect()->back()->with('error', 'No se encontró matrícula para este estudiante.');
    }

    // 2. Extraer todos los grupo_id
    $grupoIds = array_column($matriculas, 'grupo_id');
    log_message('debug', 'Grupo IDs del estudiante: ' . implode(',', $grupoIds));

    // 3. Consultar las pruebas asignadas a esos grupos
    $pruebas = $pruebaModel->getDetallePruebasPorGrupos($grupoIds);

    // 4. Consultar las pruebas que ya presentó el estudiante
    $respuestas = $respuestaModel
        ->select('prueba_id')
        ->where('estudiante_id', $estudianteId)
        ->groupBy('prueba_id')
        ->findAll();

    // 5. Extraer solo los IDs de las pruebas ya respondidas
    $pruebasRespondidas = array_column($respuestas, 'prueba_id');

    // 6. Enviar datos a la vista
    $data = [
        'pruebas'             => $pruebas,
        'pruebas_respondidas' => $pruebasRespondidas
    ];

    return view('estudiante/home', $data);
}

    public function mostrar($idprueb)
    {
        log_message('info', "Cargando prueba con ID: {$idprueb}");
        $model = new PruebasModel();
        $data['lecturas_con_preguntas'] = $model->getLecturasConPreguntas($idprueb);
        $data['preguntas_sueltas']      = $model->getPreguntasSueltas($idprueb);
        $data['idprueba']               = $idprueb;
        return view('estudiante/ver_prueba', $data);
    }

    public function mostrar_calificacion($idprueb)
    {

        $estudianteId = session()->get('id_user');


        $resultados = new RespuestasModel();
        // Obtener los datos completos de la prueba

        // Organizar datos para la vista
        $data = [
            'resultados' =>  $resultados->obtenerPruebaCompleta($idprueb, $estudianteId),
        ];

        return view('estudiante/ver_prueba_calificada', $data);
    }



    public function guardar()
    {
        $respuestaModel = new RespuestasModel();
        $data = $this->request->getJSON(true);

        $pruebaId = $data['prueba_id'];
        $preguntas = $data['preguntas'];

        // ⚡ Asegura que el estudiante esté en sesión
        $estudianteId = session()->get('id_user');

        if (!$estudianteId) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'No hay estudiante en sesión'
            ]);
        }

        log_message('debug', 'Prueba: ' . $pruebaId);
        log_message('debug', 'Preguntas: ' . print_r($preguntas, true));
        log_message('debug', 'Estudiante ID: ' . $estudianteId);

        foreach ($preguntas as $preguntaId => $respuesta) {
            $respuestaModel->insert([
                'prueba_id'       => $pruebaId,
                'pregunta_id'     => $preguntaId,
                'estudiante_id'   => $estudianteId,  // 🔹 ahora sí se guarda
                'opcion_elegida'  => $respuesta,
                'fecha_respuesta' => date('Y-m-d H:i:s'),
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'ok',
            'message' => 'Respuestas guardadas correctamente'
        ]);
    }
}
