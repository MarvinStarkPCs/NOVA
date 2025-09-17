<?php
namespace App\Controllers;
use App\Models\ComboBoxModel;
use App\Models\UserManagementModel;
use App\Models\MatriculaModel;

class AdminController extends BaseController
{
  public function index()
{
    return view('administrador/home');
}



public function rematricula()
{  
      $comboModel = new ComboBoxModel(); 
    $userModel = new UserManagementModel(); 


    $data = [
        'estudiantes' => $userModel->where('role_id', 2)->findAll(),
        'jornadas'    => $comboModel->getTableData('jornadas') ?? [],
        'grados'      => $comboModel->getTableData('grados') ?? [],

    ];
return view('administrador/rematricula', $data);

}

public function store()
{
    $matriculaModel = new MatriculaModel();

    // Recibir datos del formulario
    $grupoId        = $this->request->getPost('grupo_id');
    $jornadaId      = $this->request->getPost('jornada_id');
    $fechaMatricula = $this->request->getPost('fecha_matricula');
    $estudiantes    = $this->request->getPost('estudiante_id'); // array

log_message('debug', 'Grupo ID: ' . $grupoId);
log_message('debug', 'Jornada ID: ' . $jornadaId);
log_message('debug', 'Fecha Matrícula: ' . $fechaMatricula);
log_message('debug', 'Estudiantes: ' . implode(',', $estudiantes));


    foreach ($estudiantes as $estudianteId) {
        $matriculaModel->insert([
            'grupo_id'        => $grupoId,
            'jornada_id'      => $jornadaId,
            'fecha_matricula' => $fechaMatricula,
            'user_id'   => $estudianteId,
        ]);
    }

    return redirect()->to('admin/matriculas')->with('success', 'Matrícula(s) registrada(s) correctamente');
}


public function asignacion_academica()
{
          
    $comboModel = new ComboBoxModel(); 

    $data = [

        'asignaturas'   => $comboModel->getTableData('asignaturas') ?? [],

    ];

    return view('administrador/asignacion_academica',$data);

}





    public function buscar_asignacion_academica()
    {
        if ($this->request->isAJAX()) {
            $documento = $this->request->getPost('documento');

            $profesorModel = new UserManagementModel();
            $profesor = $profesorModel->getProfesorConAsignaturas($documento);

            if ($profesor) {
                // 🔥 Devolver datos en JSON (una fila con asignaturas agrupadas)
                return $this->response->setJSON([
                    [
                        'profesor_id'        => $profesor->profesor_id,
                        'documento'          => $profesor->documento,
                        'nombre_profesor'    => $profesor->nombre_profesor,
                        'apellido_profesor'  => $profesor->apellido_profesor,
                        'email'              => $profesor->email,
                        'telefono'           => $profesor->telefono,
                        'asignaturas'        => explode(',', $profesor->asignaturas), // nombres
                        'asignaturas_ids'    => explode(',', $profesor->asignatura_ids), // ids
                    ]
                ]);
            } else {
                return $this->response->setJSON([]);
            }
        }
    }

 public function guardarAsignaturas()
{
    log_message('debug', 'Entrando a guardarAsignaturas');


    $profesorId = $this->request->getPost('profesor_id');
    $asignaturas = $this->request->getPost('asignatura_id'); // array[]

    $db = \Config\Database::connect();
    $builder = $db->table('profesor_asignaturas'); // cambia por el nombre real de tu tabla

    // ✅ Borrar asignaciones actuales del profesor
    $builder->where('profesor_id', $profesorId)->delete();

    // ✅ Insertar nuevas asignaciones
    if (!empty($asignaturas)) {
        $data = [];
        foreach ($asignaturas as $asignaturaId) {
            $data[] = [
                'profesor_id'  => $profesorId,
                'asignatura_id'=> $asignaturaId,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ];
        }
        $builder->insertBatch($data);
    }

    return $this->response->setJSON([
        'status'  => 'success',
        'message' => 'Asignaturas actualizadas correctamente'
    ]);
}



}