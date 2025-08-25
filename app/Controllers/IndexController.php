<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class IndexController extends BaseController
{
    public function index()
    {
        $session = session();

        // Verifica si el usuario está logueado
        if ($session->get('login')) {
            // Redirige al usuario a la página principal
             switch ($session->get('role_id')) {
                case 1: // profesor
                    return redirect()->to('/profesor/home');
                case 2: // estudiante
                    return redirect()->to('/estudiante/home');
                case 3: // administrador
                    return redirect()->to('/admin/home');}
        } else {
            // Muestra la vista de login si no está logueado
            return view('index');
        }
}
}

