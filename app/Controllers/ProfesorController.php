<?php

namespace App\Controllers;

use App\Models\PruebasModel;
use App\Models\UserManagementModel;
use App\Models\ComboBoxModel;
use App\Models\RespuestasModel;

class ProfesorController extends BaseController
{
    public function index()
    {
        // Obtener ID del profesor desde la sesión
        $profesor_id = session()->get('id_user');
        // ⚠️ Ajusta el nombre de la clave según como guardes el id del usuario

        // Instanciar modelo
        $pruebaModel = new PruebasModel();

        // Obtener pruebas del profesor
        $data['pruebas'] = $pruebaModel->getPruebasByProfesor($profesor_id);

        // Pasar datos a la vista
        return view('profesor/home', $data);
    }

    public function ver_resultados(){
   $userModel = new UserManagementModel();
        $combobox = new ComboBoxModel();

 $data = [
            'grupos' => $combobox->getTableData('grupos') ?? [],
            'grados' => $combobox->getTableData('grados') ?? [],
            'jornadas' => $combobox->getTableData('jornadas') ?? [],
        ];


        return view('profesor/resultados',  $data);


    }

public function buscar()
{
    if ($this->request->isAJAX()) {
        $documento = $this->request->getPost('documento');
        $grupo     = $this->request->getPost('grupo');
        $jornada   = $this->request->getPost('jornada');
        $profesorId = session()->get('id_user'); // el id del profesor

        $model = new UserManagementModel();

        if (!empty($documento)) {
            // Solo documento
            $data = $model->getPruebasPorDocumento($documento);
        } elseif (!empty($grupo) && !empty($jornada)) {
            // Jornada + Grupo + Profesor (de sesión)
            $data = $model->getPruebasPorFiltros($grupo, $jornada, $profesorId);
        } else {
            $data = []; // no mandaron datos suficientes
        }

        return $this->response->setJSON($data);
    }
}


public function mostrar_calificacion($idPrueba, $idEstudiante)
{

        $estudianteId = session()->get('id_user');

        
$resultados = new RespuestasModel();
        // Obtener los datos completos de la prueba
        
        // Organizar datos para la vista
        $data = [
            'resultados' =>  $resultados->obtenerPruebaCompleta($idPrueba, $idEstudiante),
        ];

    return view('profesor/ver_prueba_calificada', $data);
}
 
}
