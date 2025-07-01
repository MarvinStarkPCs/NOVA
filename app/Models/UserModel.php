<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $allowedFields = ['name', 'last_name', 'identification', 'password_hash', 'role_id', 'email', 'phone', 'status','login_attempts', 'last_login_attempt'];
    protected $useTimestamps = false;

    // Verifica si el usuario existe y la contraseña es correcta
    public function login($email, $password)
    {
        $user = $this->where('email', $email)->first();
log_message('info', "Intento de inicio de sesión para el usuario: {$email}");
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
}