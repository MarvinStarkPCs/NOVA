<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Mágico</title>

  <!-- Bootstrap & FontAwesome -->
  <link href="<?= base_url('assets/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/select2/dist/css/select2.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/partials/loader.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/partials/alert.css') ?>" rel="stylesheet">

  <style>
    /* Fondo mágico */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Baloo 2', cursive;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: radial-gradient(circle at top, #FFD700, #4A148C);
      overflow: hidden;
      color: #fff;
    }

    /* Efecto partículas doradas */
    body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('<?= base_url('img/icons/star.png') ?>') repeat;
      opacity: 0.25;
      z-index: 0;
    }

    /* Caja del login */
    .login-box {
      position: relative;
      z-index: 1;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 30px;
      padding: 2.5rem;
      width: 100%;
      max-width: 380px;
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
      text-align: center;
      backdrop-filter: blur(12px);
      border: 2px solid rgba(255, 215, 0, 0.6);
      animation: pop 0.8s ease;
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

    /* Avatar mágico */
    .avatar {
      width: 110px;
      margin-bottom: 15px;
      transition: transform 0.3s ease, filter 0.3s ease;
      filter: drop-shadow(0 0 10px gold);
    }

    .avatar.cover-eyes {
      transform: rotate(12deg) scale(1.1);
      filter: grayscale(80%) drop-shadow(0 0 10px #FFD700);
    }

    h1 {
      font-size: 2rem;
      background: linear-gradient(90deg, #FFD700, #FFA500);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 1rem;
    }

    /* Inputs */
    .form-control {
      border-radius: 25px;
      text-align: center;
      border: 2px solid transparent;
      background: rgba(255, 255, 255, 0.8);
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: gold;
      box-shadow: 0 0 15px rgba(255, 215, 0, 0.6);
    }

    /* Botón mágico */
    .btn-gold {
      background: linear-gradient(45deg, #FFD700, #FFA500);
      color: #4A148C;
      font-weight: bold;
      border-radius: 25px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border: none;
    }

    .btn-gold:hover {
      transform: scale(1.05);
      box-shadow: 0 0 20px gold;
    }

    /* Toggle password */
    .toggle-password {
      position: absolute;
      top: 50%;
      right: 1rem;
      transform: translateY(-50%);
      background: none;
      border: none;
      font-size: 1.2rem;
      color: gold;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <?= view('partials/alert') ?>

  <div class="login-box">
    <img id="avatar" src="https://cdn-icons-png.flaticon.com/512/4213/4213482.png" class="avatar" alt="Muñequito feliz" />
    <h1><i class="fas fa-magic"></i> ¡Bienvenido, explorador!</h1>

    <form method="post" action="<?= base_url('authenticate') ?>" class="mt-4">
      <?= csrf_field() ?>
      <div class="form-group">
        <input type="email" name="email" class="form-control" value="<?= old('email') ?>"
          placeholder="Tu correo mágico" required>
      </div>

      <div class="form-group position-relative">
        <input type="password" name="password" id="password" class="form-control" placeholder="Tu clave secreta" required
          onfocus="coverEyes()" onblur="uncoverEyes()" aria-label="Contraseña">
        <button type="button" class="toggle-password" onclick="togglePassword()" aria-label="Mostrar u ocultar contraseña">
          <i id="eye-icon" class="fas fa-eye"></i>
        </button>
      </div>

      <button type="submit" class="btn btn-gold btn-block mt-3">
        <i class="fas fa-dragon"></i> Entrar
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
