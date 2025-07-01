<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use Faker\Provider\Base;

class CrearPruebaController extends BaseController
{
    public function index()
    {
       
        return view('system\crearprueba');
    }
}