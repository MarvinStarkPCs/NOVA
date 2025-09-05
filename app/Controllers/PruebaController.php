<?php

namespace App\Controllers;

use App\Models\ProfesorAsignaturasModel;
use App\Models\PruebasModel;
use CodeIgniter\Controller;
use App\Models\ComboBoxModel;
use App\Models\PruebaGruposModel;
class PruebaController extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('id_user');
        log_message('info', "Cargando asignaturas para el profesor ID: {$userId}");

        $asignaturas = new ProfesorAsignaturasModel();
        $data['asignaturas'] = $asignaturas->getAsignaturasByProfesor($userId);

        return view('profesor/crearprueba', $data);
    }

    public function mostrar($idprueb)
    {
        log_message('info', "Cargando prueba con ID: {$idprueb}");
        $model = new PruebasModel();
        $data['lecturas_con_preguntas'] = $model->getLecturasConPreguntas($idprueb);
        $data['preguntas_sueltas']      = $model->getPreguntasSueltas($idprueb);
        $data['idprueba']               = $idprueb;

        return view('profesor/ver_prueba', $data);
    }

 
public function asignar()
{
    $prueba_id = $this->request->getPost('prueba_id');
    $grupo_id = $this->request->getPost('grupo_id');
    $fecha_limite = $this->request->getPost('fecha_limite');
    // Modelo para asignaciones
    $pruebaMatriculaModel = new PruebaGruposModel();

    // Guardar la asignación en la tabla
    $pruebaMatriculaModel->insert([
        'prueba_id' => $prueba_id,
        'grupo_id' => $grupo_id,
        'fecha_asignacion' => date('Y-m-d H:i:s'),
        'fecha_limite' => $fecha_limite,
    ]);

    // Redirigir a la lista de pruebas con mensaje de éxito
    return redirect()->to('/profesor/asignar/')
                     ->with('success', 'La prueba ha sido asignada correctamente al grupo.');
}


    public function RenderAsignar()
    {    
        $combobox = new ComboBoxModel();
         $model = new PruebasModel();
          // Obtener ID del profesor desde la sesión
        $profesor_id = session()->get('id_user');
        // ⚠️ Ajusta el nombre de la clave según como guardes el id del usuario

        // Instanciar modelo
        $pruebaModel = new PruebasModel();

        // Obtener pruebas del profesor
        $data['pruebas'] = $pruebaModel->getPruebasByProfesor($profesor_id);

            $data['grados']   = $combobox->getTableData('grados') ?? [];

        return view('profesor/asignar_prueba', $data);
    }

    public function guardar()
    {
        try {
            $jsonData = $this->request->getJSON(true);

            if (
                !$jsonData ||
                empty($jsonData['nombre']) ||
                empty($jsonData['asignatura_id']) ||
                empty($jsonData['bloques'])
            ) {
                return $this->response->setJSON(['error' => 'Datos incompletos'])->setStatusCode(400);
            }

            $session = session();
            $profesor_id = $session->get('id_user');
            if (!$profesor_id) {
                return $this->response->setJSON(['error' => 'Usuario no autenticado'])->setStatusCode(401);
            }

            $db = \Config\Database::connect();
            $db->transBegin();

            // 1. Insertar prueba
            $db->table('pruebas')->insert([
                'nombre'        => trim($jsonData['nombre']),
                'descripcion'   => trim($jsonData['descripcion'] ?? ''),
                'profesor_id'   => $profesor_id,
                'asignatura_id' => intval($jsonData['asignatura_id'])
            ]);
            $prueba_id = $db->insertID();

            // 2. Recorrer bloques
            foreach ($jsonData['bloques'] as $bloque) {
                if (empty($bloque['preguntas'])) {
                    throw new \Exception("El bloque no tiene preguntas");
                }

                $lectura_id = null;
                if ($bloque['tipo'] === 'con-texto') {
                    if (empty($bloque['titulo']) || empty($bloque['texto'])) {
                        throw new \Exception("El bloque con texto debe tener título y contenido");
                    }
                    $db->table('lecturas')->insert([
                        'titulo'    => trim($bloque['titulo']),
                        'contenido' => trim($bloque['texto']),
                        'prueba_id' => $prueba_id
                    ]);
                    $lectura_id = $db->insertID();
                }

                foreach ($bloque['preguntas'] as $pregunta) {
                    if (
                        empty($pregunta['enunciado']) ||
                        empty($pregunta['opciones']) || count($pregunta['opciones']) !== 4 ||
                        empty($pregunta['correcta']) ||
                        empty($pregunta['justificacion'])
                    ) {
                        throw new \Exception("Datos incompletos en alguna pregunta");
                    }

                    $db->table('preguntas')->insert([
                        'enunciado'       => trim($pregunta['enunciado']),
                        'opcion_a'        => $pregunta['opciones'][0],
                        'opcion_b'        => $pregunta['opciones'][1],
                        'opcion_c'        => $pregunta['opciones'][2],
                        'opcion_d'        => $pregunta['opciones'][3],
                        'opcion_correcta' => strtolower($pregunta['correcta']),
                        'justificacion'   => trim($pregunta['justificacion']),
                        'tipo'            => 'multiple_choice',
                        'prueba_id'       => $prueba_id
                    ]);
                    $pregunta_id = $db->insertID();

                    if ($lectura_id) {
                        $db->table('lectura_preguntas')->insert([
                            'lectura_id'  => $lectura_id,
                            'pregunta_id' => $pregunta_id
                        ]);
                    }
                }
            }

            if ($db->transStatus() === false) {
                $db->transRollback();
                return $this->response->setJSON(['error' => 'Error al guardar en la base de datos'])->setStatusCode(500);
            }

            $db->transCommit();
            return $this->response->setJSON(['message' => 'Prueba guardada exitosamente']);
        } catch (\Throwable $e) {
            if (isset($db) && $db->transStatus() !== false) {
                $db->transRollback();
            }
            log_message('error', 'Error en guardar prueba: ' . $e->getMessage());
            return $this->response->setJSON([
                'error' => 'Error inesperado',
                'details' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }



 
}
