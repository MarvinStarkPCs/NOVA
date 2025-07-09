<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Asignaturas</title>

  <!-- Bootstrap & FontAwesome -->
  <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Baloo 2', cursive;
      background: linear-gradient(to top left, #FFDEE9, #B5FFFC);
      min-height: 100vh;
      padding-top: 60px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .avatar-menu {
      position: fixed;
      top: 15px;
      right: 20px;
      z-index: 1050;
    }

    .avatar-menu img {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #6c757d;
      cursor: pointer;
    }

    .start-box {
      background: white;
      border-radius: 30px;
      padding: 3rem;
      text-align: center;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .start-box h2 {
      font-size: 2rem;
      color: #4A148C;
      margin-bottom: 2rem;
    }

    .start-btn {
      background-color: #2A6322;
      color: white;
      font-size: 1.4rem;
      border-radius: 50px;
      padding: 15px 40px;
      border: none;
      transition: 0.3s;
    }

    .start-btn:hover {
      background-color: #24511C;
      transform: scale(1.05);
    }
  </style>
</head>
<body>

<!-- Avatar flotante con menú -->
<?php
  $session = session();
  $nombreUsuario = $session->get('name') . ' ' . $session->get('last_name') ?? 'Invitado';
?>
<div class="avatar-menu dropdown">
  <a href="#" class="dropdown-toggle" id="avatarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <img src="<?= base_url('img/undraw_profile.svg'); ?>" alt="Avatar">
  </a>
  <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="avatarDropdown">
    <a class="dropdown-item" href="<?= base_url('estudiante/profile'); ?>">
      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Perfil
    </a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item text-danger" href="<?= base_url('logout'); ?>">
      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Cerrar sesión
    </a>
  </div>
</div>

<!-- Contenido principal con botón -->
<div class="start-box">
  <h2>¡Bienvenido! ¿Estás listo para comenzar?</h2>
  <a href="<?= base_url('estudiante/resolver/mostrar'); ?>" class="start-btn">Empezar prueba</a>
</div>

<!-- Scripts -->
<script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

</body>
</html>
