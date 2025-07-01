<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class MenuController extends BaseController
{
    public function index()
    {
     
            // Muestra la vista de login si no está logueado
            return view('home');
        
}
}

