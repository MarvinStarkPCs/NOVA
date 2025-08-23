<?php
namespace App\Models;
use CodeIgniter\Model;

class UserManagementModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'name', '', 'login','last_name','email', 'email_verified_at',
        'password', 'remember_token',
        'created_at', 'updated_at',
        'role_id','documento','telefono','direccion','genero','fecha_nacimiento','estado'
    ];
    
    protected $returnType = 'array';
    protected $useTimestamps = true; // usa created_at y updated_at automáticamente
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Método para obtener usuarios con su rol
public function getUsers($id = null) 
{
    $builder = $this->select('*, roles.nombre AS role_name')
                    ->join('roles', 'roles.id = users.role_id', 'left');

    if ($id !== null) {
        $builder->where('users.id', $id);

        // Imprimir la consulta generada

        $data = $builder->first();
        log_message('debug', 'Resultado de la consulta: ' . print_r($data, true));
        return $data;
    }

    return $builder->findAll();
}

 public function getMatriculaByEstudiante($estudianteId)
    {
        return $this->db->table('matriculas m')
            ->select('
                m.id AS matricula_id,
                m.fecha_matricula,
                u.id AS estudiante_id,
                u.name AS estudiante,
                u.documento,
                u.email,
                u.telefono,
                u.direccion,
                u.genero,
               r.name as role,
                u.fecha_nacimiento,
                u.estado,
                gra.nombre AS grado,
                gru.nombre AS grupo,
                j.nombre AS jornada
            ')
            ->join('users u', 'm.estudiante_id = u.id')
            ->join('grupos gru', 'm.grupo_id = gru.id')
            ->join('grados gra', 'gru.grado_id = gra.id')
            ->join('jornadas j', 'm.jornada_id = j.id')
            ->join('roles r', 'u.role_id = r.id')
            ->get()
            ->getRow(); // devuelve un solo registro
    }


    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function getUserById($id)
    {
        return $this->where('id', $id)->first();
    }
}
