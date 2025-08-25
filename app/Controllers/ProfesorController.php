<?php

namespace App\Controllers;

use App\Models\PruebasModel;

class ProfesorController extends BaseController
{
    public function index()
    {
        $julian = "hola";



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

    

 
}
