<?php
namespace App\Models;
use CodeIgniter\Model;

class UserManagementModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'name', 'email', 'email_verified_at',
        'password', 'remember_token',
        'created_at', 'updated_at',
        'role_id'
    ];
    
    protected $returnType = 'array';
    protected $useTimestamps = true; // usa created_at y updated_at automáticamente
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Método para obtener usuarios con su rol
public function getUsers($id = null) 
{
    $builder = $this->select('users.id, users.name, users.email, users.email_verified_at, users.created_at, roles.nombre AS role_name')
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



    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function getUserById($id)
    {
        return $this->where('id', $id)->first();
    }
}
