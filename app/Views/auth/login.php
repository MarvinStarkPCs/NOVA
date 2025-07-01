<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Divertido</title>

  <!-- Bootstrap & FontAwesome -->
  <link href="<?= base_url('assets/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
  <!-- Otros estilos -->
  <link href="<?= base_url('assets/select2/dist/css/select2.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/partials/loader.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/partials/alert.css') ?>" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Baloo 2', cursive;
      background: linear-gradient(135deg, #FECFEF, #A0E7E5);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-box {
      background: #fff;
      border-radius: 30px;
      padding: 2.5rem;
      width: 100%;
      max-width: 380px;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
      text-align: center;
      animation: pop 0.6s ease;
    }

    @keyframes pop {
      0% {
        transform: scale(0.8);
        opacity: 0;
      }

      100% {
        transform: scale(1);
        opacity: 1;
      }
    }

    .avatar {
      width: 100px;
      margin-bottom: 15px;
      transition: transform 0.3s ease;
    }

    .avatar.cover-eyes {
      transform: rotate(10deg) scale(1.1);
      filter: grayscale(80%);
    }

    h1 {
      font-size: 2rem;
      color: #4A148C;
    }

    .form-control:focus {
      border-color: #4A148C;
      box-shadow: 0 0 0 0.2rem rgba(74, 20, 140, 0.25);
    }

    .toggle-password {
      position: absolute;
      top: 50%;
      right: 1rem;
      transform: translateY(-50%);
      background: none;
      border: none;
      font-size: 1.2rem;
      color: #4A148C;
    }

    .btn-purple {
      background-color: #4A148C;
      color: #fff;
      border-radius: 25px;
    }

    .btn-purple:hover {
      background-color: #6A1B9A;
    }
  </style>
</head>

<body>
  <?= view('partials/alert') ?>

  <div class="login-box">
    <img id="avatar" src="https://cdn-icons-png.flaticon.com/512/4213/4213482.png" class="avatar" alt="Muñequito feliz" />
    <h1><i class="fas fa-child"></i> ¡Hola, explorador!</h1>

    <form method="post" action="<?= base_url('authenticate') ?>" class="mt-4">
      <?= csrf_field() ?>
      <div class="form-group">
<input type="email" name="email" class="form-control" value="<?= old('email') ?>" placeholder="Tu correo mágico" required>
      </div>

      <div class="form-group position-relative">
        <input type="password" name="password" id="password" class="form-control" placeholder="Tu clave secreta" required onfocus="coverEyes()" onblur="uncoverEyes()" aria-label="Contraseña">
        <button type="button" class="toggle-password" onclick="togglePassword()" aria-label="Mostrar u ocultar contraseña">
          <i id="eye-icon" class="fas fa-eye"></i>
        </button>
      </div>

      <button type="submit" class="btn btn-purple btn-block mt-3">
        <i class="fas fa-rocket"></i> Entrar
      </button>
    </form>
  </div>

  <!-- JS Scripts -->
  <script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/jquery-easing/jquery.easing.min.js') ?>"></script>
  <script src="<?= base_url('assets/sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>
  <script src="<?= base_url('assets/select2/dist/js/select2.min.js') ?>"></script>
  <script src="<?= base_url('js/sb-admin-2.min.js') ?>"></script>
  <script src="<?= base_url('assets/datatables/jquery.dataTables.min.js') ?>"></script>
  <script src="<?= base_url('assets/datatables/dataTables.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('js/demo/datatables-demo.js') ?>"></script>
  <script src="<?= base_url('js/toggleloader.js') ?>"></script>

  <!-- Funciones JS -->
  <script>
    const passwordField = document.getElementById('password');
    const avatar = document.getElementById('avatar');
    const eyeIcon = document.getElementById('eye-icon');
    let passwordVisible = false;

    function coverEyes() {
      avatar.classList.add('cover-eyes');
    }

    function uncoverEyes() {
      if (!passwordVisible) {
        avatar.classList.remove('cover-eyes');
      }
    }

    function togglePassword() {
      passwordVisible = !passwordVisible;
      passwordField.type = passwordVisible ? "text" : "password";
      eyeIcon.className = passwordVisible ? "fas fa-eye-slash" : "fas fa-eye";
      avatar.classList.toggle('cover-eyes', !passwordVisible);
    }
  </script>
</body>

</html>
