<?php

namespace App\Controllers;

use App\Models\UserManagementModel;
use App\Models\ComboBoxModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\SendEmail;
use App\Models\MatriculaModel;
use App\Models\ProfesorAsignaturasModel;

class UserManagementController extends BaseController
{
    public function index()
    {
        $userModel = new UserManagementModel();
        $combobox = new ComboBoxModel();

        $data = [
            'users' => $userModel->getUsers() ?? [],
            'roles' => $combobox->getTableData('roles') ?? [],
            'grupos' => $combobox->getTableData('grupos') ?? [],
            'grados' => $combobox->getTableData('grados') ?? [],
            'jornadas' => $combobox->getTableData('jornadas') ?? [],
            'asignaturas' => $combobox->getTableData('asignaturas') ?? [],


        ];

        return view('administrador/UserManagement/UserManagement', $data);
    }

   public function editUser($id)
    {
        $roleModel = new ComboBoxModel();

        log_message('info', 'Iniciando el méto11do editUser() con ID: ' . $id);

        $data['user'] = (new UserManagementModel())->getUserById($id) ?? [];
        $data['roles']    = $roleModel->getTableData('roles') ?? [];

        log_message('info', 'Datos del usuario: ' . json_encode($data['user']));
        return view('administrador/UserManagement/Update', $data);
        
    }
  public function detailUser($id)
    {
        $roleModel = new ComboBoxModel();

        log_message('info', 'Iniciando el méto11do editUser() con ID: ' . $id);

        $data['user'] = (new UserManagementModel())->getUserById($id) ?? [];
        $data['roles']    = $roleModel->getTableData('roles') ?? [];

        log_message('info', 'Datos del usuario: ' . json_encode($data['user']));
        
        return view('administrador/UserManagement/Detail', $data);
    }
public function addUser()
{
    log_message('info', 'Iniciando el método addUser()');
    $validation = \Config\Services::validation();
    $db = \Config\Database::connect();
    $model = new UserManagementModel();
    helper('login_helper');

    $roleId = $this->request->getPost('role_id');

    // 🔹 Reglas comunes a todos los usuarios
    $rules = [
        'name'             => 'required|min_length[2]|max_length[255]',
        'last_name'        => 'required|max_length[255]',
        'email'            => 'required|valid_email|max_length[255]|is_unique[users.email]',
        'role_id'          => 'required|integer',
        'documento'        => 'required|max_length[50]|is_unique[users.documento]',
        'telefono'         => 'required|max_length[20]',
        'direccion'        => 'required|max_length[255]',
        'genero'           => 'required|max_length[20]',
        'fecha_nacimiento' => 'required|valid_date[Y-m-d]',
        'status'           => 'required|in_list[activo,inactivo]',
    ];

    // 🔹 Validaciones adicionales según el rol
    if ($roleId == 1) { 
        // Profesor → debe tener asignaturas
        $rules['asignatura_id'] = 'required';
    }

    if ($roleId == 2) { 
        // Estudiante → debe tener matrícula completa
        $rules['grado_id']       = 'required|integer';
        $rules['grupo_id']       = 'required|integer';
        $rules['jornada']        = 'required|integer';
        $rules['fecha_matricula']= 'required|valid_date[Y-m-d]';
    }

    // 🔹 Ejecutar validación
    if (!$this->validate($rules)) {
        log_message('error', 'Validación fallida en addUser: ' . json_encode($validation->getErrors()));
        return redirect()->back()->withInput()->with('errors-insert', $validation->getErrors());
    }

    // Si llega aquí, es porque pasó todas las validaciones
    $login = generate_login($this->request->getPost('name'), $this->request->getPost('last_name'));

    $data = [
        'login'            => $login,
        'name'             => $this->request->getPost('name'),
        'last_name'        => $this->request->getPost('last_name'),
        'documento'        => $this->request->getPost('documento'),
        'email'            => $this->request->getPost('email'),
        'telefono'         => $this->request->getPost('telefono'),
        'direccion'        => $this->request->getPost('direccion'),
        'genero'           => $this->request->getPost('genero'),
        'fecha_nacimiento' => $this->request->getPost('fecha_nacimiento'),
        'role_id'          => $roleId,
        'estado'           => $this->request->getPost('status'),
        'password' => password_hash($this->request->getPost('documento'), PASSWORD_DEFAULT),
    ];

    try {
        $db->transBegin();

        // Insertar usuario
        $userId = $model->insert($data);
        if (!$userId) {
            throw new \Exception("No se pudo insertar el usuario");
        }

        // Si es profesor → guardar asignaturas
        if ($roleId == 1) {
            $asignaturas = $this->request->getPost('asignatura_id');
            $profesorAsignaturasModel = new ProfesorAsignaturasModel();

            foreach ($asignaturas as $asignaturaId) {
                $profesorAsignaturasModel->insert([
                    'profesor_id'   => $userId,
                    'asignatura_id' => $asignaturaId
                ]);
            }
        }

        // Si es estudiante → guardar matrícula
        if ($roleId == 2) {
            $matriculaModel = new MatriculaModel();
            $matriculaModel->insert([
                'user_id'        => $userId,
                'jornada_id'     => $this->request->getPost('jornada'),
                'grupo_id'       => $this->request->getPost('grupo_id'),
                'fecha_matricula'=> $this->request->getPost('fecha_matricula'),
            ]);
        }

        $db->transCommit();
        return redirect()->to('/admin/usermanagement')->with('success', 'Usuario agregado correctamente');

    } catch (\Exception $e) {
        $db->transRollback();
        log_message('error', 'Error al agregar usuario: ' . $e->getMessage());
        return redirect()->to('/admin/usermanagement')->with('error', 'Error al agregar el usuario: ' . $e->getMessage());
    }
}








    public function show($id)
    {
        $userModel = new UserManagementModel();
        $user = $userModel->find($id);

        if ($user) {
            return $this->response->setJSON($user);
        } else {
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                ->setJSON(['status' => 'error', 'message' => 'Usuario no encontrado']);
        }
    }



    public function updateUser($id)
    {
        $model = new UserManagementModel();

        $rules = [
            'login' => "required|min_length[4]|max_length[100]|is_unique[users.login,id,{$id}]",
            'name' => 'required|min_length[2]|max_length[255]',
            'last_name' => 'permit_empty|max_length[255]',
            'email' => "required|valid_email|max_length[255]|is_unique[users.email,id,{$id}]",
            'role_id' => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors-edit', \Config\Services::validation()->getErrors());
        }

        $data = [
            'login' => $this->request->getPost('login'),
            'name' => $this->request->getPost('name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'role_id' => $this->request->getPost('role_id'),
        ];

        try {
            $model->update($id, $data);
            return redirect()->to('/admin/usermanagement')->with('success', 'Usuario actualizado correctamente');
        } catch (\Exception $e) {
            log_message('error', 'Error al actualizar usuario: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('errors-edit', ['db_error' => 'Error al actualizar el usuario.']);
        }
    }

    public function deleteUser($id)
    {
        $userModel = new UserManagementModel();
        try {
            $result = $userModel->delete($id);

            if ($result) {
                return redirect()->to('/admin/usermanagement')->with('success', 'Usuario eliminado correctamente.');
            } else {
                return redirect()->to('/admin/usermanagement')->with('error', 'No se pudo eliminar el usuario.');
            }
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            if (strpos($e->getMessage(), 'Cannot delete or update a parent row') !== false) {
                return redirect()->to('/admin/usermanagement')->with('error', 'No se puede eliminar el usuario porque está asociado a otros registros.');
            }
            return redirect()->to('/admin/usermanagement')->with('error', 'Error al intentar eliminar el usuario.');
        }
    }
    public function verPrueba($asignaturaId)
    {
        $preguntaModel = new \App\Models\PreguntaModel();
        $lecturaModel  = new \App\Models\LecturaModel();

        // Bloques con lectura (tipo: con-texto)
        $lecturas = $lecturaModel
            ->where('asignatura_id', $asignaturaId)
            ->findAll();

        foreach ($lecturas as &$lectura) {
            $lectura['preguntas'] = $preguntaModel
                ->select('preguntas.*')
                ->join('lecturas_preguntas', 'preguntas.id = lecturas_preguntas.pregunta_id')
                ->where('lecturas_preguntas.lectura_id', $lectura['id'])
                ->findAll();
        }

        // Preguntas sueltas (tipo: solo-preguntas)
        $preguntasSueltas = $preguntaModel
            ->where('asignatura_id', $asignaturaId)
            ->where('tipo', 'solo-preguntas')
            ->findAll();

        return view('estudiante/ver_prueba', [
            'lecturas' => $lecturas,
            'preguntasSueltas' => $preguntasSueltas,
        ]);
    }
    public function showComboBox()
    {
        $tabla = $this->request->getPost('tabla') ?? '';
        $campo = $this->request->getPost('campo') ?? 'id';
        $id    = $this->request->getPost('id') ?? '';
        log_message('info', 'Recibiendo solicitud para mostrar datos de la tabla: ' . $tabla . ', campo: ' . $campo . ', id: ' . $id);
        $model = new ComboBoxModel();
        $result = $model->getById($tabla, $id, $campo);
        log_message('info', 'Datos obtenidos de la tabla ' . $tabla . ': ' . json_encode($result));
        return $this->response->setJSON($result);
    }
}
