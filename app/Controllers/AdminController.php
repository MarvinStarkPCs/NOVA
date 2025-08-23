<?php
namespace App\Controllers;
use App\Models\ComboBoxModel;
use App\Models\UserManagementModel;
class AdminController extends BaseController
{
  public function index()
{
    $comboModel = new ComboBoxModel(); 
    $userModel = new UserManagementModel(); 
    // Traer solo los usuarios con rol 2 (por ejemplo, estudiantes)
    $data = [
        'jornadas'    => $comboModel->getTableData('jornadas') ?? [],
        'grupos'      => $comboModel->getTableData('grupos') ?? [],
    ];

    return view('administrador/home', $data);
}

}
