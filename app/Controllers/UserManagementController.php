<?php 
namespace App\Controllers;

use App\Models\UserManagementModel;
use App\Models\ComboBoxModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\SendEmail;

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

        ];

        return view('security/UserManagement/UserManagement', $data);
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

    public function addUser()
    {
        log_message('info', 'Iniciando el método addUser()');

        $validation = \Config\Services::validation();
        $model = new UserManagementModel();

        $rules = [
            'login' => 'required|min_length[4]|max_length[100]|is_unique[users.login]',
            'name' => 'required|min_length[2]|max_length[255]',
            'last_name' => 'permit_empty|max_length[255]',
            'email' => 'required|valid_email|max_length[255]|is_unique[users.email]',
            'role_id' => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors-insert', $validation->getErrors());
        }

        $data = [
            'login' => $this->request->getPost('login'),
            'name' => $this->request->getPost('name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash("SCOPECAPITAL2025", PASSWORD_DEFAULT),
            'role_id' => $this->request->getPost('role_id'),
        ];

        try {
            $model->insert($data);

            $email = new SendEmail();

            $message = '<html><body><p>Bienvenido ' . esc($data['name']) . ' ' . esc($data['last_name']) . ',<br>Tu cuenta ha sido creada.<br><b>Usuario:</b> ' . esc($data['email']) . '<br><b>Contraseña:</b> SCOPECAPITAL2025</p></body></html>';

            $email->send($data['email'], 'Bienvenido a Scope Capital', $message);

            return redirect()->to('/admin/usermanagement')->with('success', 'Usuario agregado correctamente');
        } catch (\Exception $e) {
            log_message('error', 'Error al agregar usuario: ' . $e->getMessage());
            return redirect()->to('/admin/usermanagement')->with('error', 'Error al agregar el usuario');
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

}