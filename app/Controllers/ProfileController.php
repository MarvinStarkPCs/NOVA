<?php
namespace App\Controllers;

use App\Models\UserManagementModel;

class ProfileController extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('id_user');


        $userModel = new UserManagementModel();
        $userData = $userModel->getUsers($userId);
log_message('info', 'User data retrieved: ' . json_encode($userData));
        return view('aside/profile/profile', ['user' => $userData]);
    }
}
