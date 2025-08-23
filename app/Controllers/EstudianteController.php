<?php

namespace App\Controllers;
use App\Models\PruebasModel;
use CodeIgniter\Controller;
use App\Models\MatriculaModel;
class EstudianteController extends BaseController
{
public function index()
{
    // Consultar la matrícula del estudiante logueado
    $matriculaModel = new MatriculaModel();
    $matricula = $matriculaModel
        ->select('grupo_id')
        ->where('user_id', session()->get('id_user'))
        ->first();

    if (!$matricula) {
        // Si no hay matrícula, puedes redirigir o mostrar mensaje
        return redirect()->back()->with('error', 'No se encontró matrícula para este estudiante.');
    }

    $grupoId = $matricula['grupo_id']; // Extraer el grupo_id
log_message('debug', 'Grupo ID del estudiante: ' . $grupoId);
    // Consultar las pruebas asignadas a ese grupo
    $pruebaModel = new PruebasModel();
    $data['pruebas'] = $pruebaModel->getDetallePruebasPorGrupo($grupoId);
log_message('debug', 'Pruebas encontradas: ' . print_r($data['pruebas'], true));
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

}

