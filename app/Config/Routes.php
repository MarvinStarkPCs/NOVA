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

// Rutas protegidas (requieren autenticación)
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'HomeController::index');
    // Rutas de autenticación (protegidas) para el gestion de extras
   
    $routes->get('setting', 'ConfigurationController::index');
    $routes->post('setting/save_security_settings', 'ConfigurationController::saveSecuritySettings');
    $routes->post('setting/save_smtp', 'ConfigurationController::saveSMTPConfig');
    ///profile
    $routes->get('profile', 'ProfileController::index');
    // Rutas de autenticación (protegidas) para el modulo de sistema
    //pqrsmanagement
    $routes->get('pqrsmanagement', 'PqrsManagementController::index');
    $routes->post('pqrsmanagement/filter', 'PqrsManagementController::filterRequests');
    $routes->get('pqrsmanagement/cancel-request/(:num)', 'PqrsManagementController::cancelrequest/$1');
    $routes->post('pqrsmanagement/getDetails', 'PqrsManagementController::detailsRequest');
    $routes->post('pqrsmanagement/resolved-request', 'PqrsManagementController::solveRequest');

    ///transactions
    $routes->get('transactions', 'TransactionsController::index');
    $routes->post('transactions/search', 'TransactionsController::search');
    $routes->post('transactions/pay', 'TransactionsController::pay');
    // Rutas de autenticación (protegidas) para el modulo de seguridad
   
    // Rutas de autenticación (protegidas) para el modulo de historial
    
    ///usermanagemen
    $routes->get('usermanagement', 'UserManagementController::index'); // Listar usuarios
    $routes->get('usermanagement/show/(:num)', 'UserManagementController::show/$1'); // Obtener un usuario específico
    $routes->post('usermanagement/add', 'UserManagementController::addUser'); // Crear usuario
    $routes->post('usermanagement/update/(:num)', 'UserManagementController::updateUser/$1'); // Actualizar usuario
    $routes->get('usermanagement/delete/(:num)', 'UserManagementController::deleteUser/$1'); // Eliminar usuario
    ///changepassword
    $routes->get('changepassword', 'ChangePasswordController::index');  // Cargar formulario
    $routes->post('changepassword/update', 'ChangePasswordController::updatePassword');  // Enviar formulario

    // Rutas de autenticación (protegidas) para crear pruebas
    $routes->get('createexam', 'CrearPruebaController::index');
    $routes->post('createexam/guardar-prueba', 'CrearPruebaController::guardar');

});


$routes->group('estudiante', ['filter' => 'auth'], function ($routes) {
  
    $routes->get('menu', 'MenuController::index');

    $routes->get('resolver/mostrar', 'ResolverPruebaController::mostrar');
$routes->post('resolver/guardarRespuestas', 'ResolverPruebaController::guardarRespuestas');

        $routes->get('profile', 'ProfileController::index');

    

});
