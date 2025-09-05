<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//rutas por vista
// Rutas de autenticación (no protegidas)
$routes->get('/', 'IndexController::index');
$routes->get('login', 'AuthController::index');
$routes->post('authenticate', 'AuthController::authenticate');
$routes->get('logout', 'AuthController::logout');

// Rutas de autenticación (protegidas) para el modulo de sistema

$routes->group('profesor', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'HomeController::index');
    $routes->get('profile', 'ProfileController::index');
    $routes->get('asignar', 'PruebaController::RenderAsignar');
    $routes->post('asignar_prueba', 'PruebaController::asignar');  // Cargar formulario
        $routes->get('results', 'ProfesorController::ver_resultados');

    $routes->get('home', 'ProfesorController::index');
    $routes->get('pruebas/(:num)', 'PruebaController::mostrar/$1');  // Cargar formulario
    $routes->get('createexam', 'PruebaController::index');  // Cargar formulario
    $routes->post('createexam/guardar-prueba', 'PruebaController::guardar');  // Enviar formulario
    $routes->post('usermanagement/showComboBox', 'UserManagementController::showComboBox');
    $routes->get('changepassword', 'ChangePasswordController::index');  // Cargar formulario
    $routes->post('changepassword/update', 'ChangePasswordController::updatePassword');  // Enviar formulario

});

// Rutas protegidas (requieren autenticación)
$routes->group('admin', ['filter' => 'auth'], function ($routes) {

    $routes->get('home', 'AdminController::index');
    $routes->get('rematricula', 'AdminController::index');
    // $routes->get('setting', 'ConfigurationController::index');
    // $routes->post('setting/save_security_settings', 'ConfigurationController::saveSecuritySettings');
    // $routes->post('setting/save_smtp', 'ConfigurationController::saveSMTPConfig');
    // ///profile
    $routes->get('profile', 'ProfileController::index');
    // ///usermanagemen
    $routes->get('usermanagement', 'UserManagementController::index'); // Listar usuarios
    $routes->get('usermanagement/show/(:num)', 'UserManagementController::show/$1'); // Obtener un usuario específico
    $routes->post('usermanagement/add', 'UserManagementController::addUser'); // Crear usuario
    $routes->post('usermanagement/update/(:num)', 'UserManagementController::updateUser/$1'); // Actualizar usuario
    $routes->get('usermanagement/delete/(:num)', 'UserManagementController::deleteUser/$1'); // Eliminar usuario
    $routes->post('usermanagement/showComboBox', 'UserManagementController::showComboBox');
    // ///changepassword
    $routes->get('changepassword', 'ChangePasswordController::index');  // Cargar formulario
    $routes->post('changepassword/update', 'ChangePasswordController::updatePassword');  // Enviar formulario



});


$routes->group(
    'estudiante',
    ['filter' => 'auth'],
    function ($routes) {
            $routes->get('prueba/(:num)', 'EstudianteController::mostrar/$1');  // Cargar formulario
            $routes->post('prueba/guardar', 'EstudianteController::guardar');
            $routes->get('calificacion/prueba/(:num)', 'EstudianteController::mostrar_calificacion/$1');  // Cargar formulario

        $routes->get('home', 'EstudianteController::index');
        $routes->get('resolver/mostrar', 'ResolverPruebaController::mostrar');
        $routes->post('resolver/guardarRespuestas', 'ResolverPruebaController::guardarRespuestas');
        $routes->get('profile', 'ProfileController::index');
        $routes->get('changepassword', 'ChangePasswordController::index');  // Cargar formulario
        $routes->post('changepassword/update', 'ChangePasswordController::updatePassword');  // Enviar formulario
    }
);
