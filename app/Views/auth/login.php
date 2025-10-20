<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ingreso - Plataforma Educativa</title>

  <!-- Bootstrap & FontAwesome -->
  <link href="<?= base_url('assets/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/select2/dist/css/select2.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/partials/loader.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/partials/alert.css') ?>" rel="stylesheet">

  <style>
    /* Fondo institucional */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #B3C69B, #8EA576);
      overflow: hidden;
      color: #2A3C1B;
    }

    /* Fondo con textura sutil */
    body::before {
      content: "";
      position: absolute;
      inset: 0;
      background: url('<?= base_url('img/icons/leaf-pattern.png') ?>') repeat;
      opacity: 0.1;
      z-index: 0;
    }

    /* Caja del login */
    .login-box {
      position: relative;
      z-index: 1;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 20px;
      padding: 2.5rem;
      width: 100%;
      max-width: 400px;
      text-align: center;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
      border: 2px solid #8EA576;
      animation: pop 0.8s ease;
    }

    @keyframes pop {
      0% { transform: scale(0.8); opacity: 0; }
      100% { transform: scale(1); opacity: 1; }
    }

    /* Avatar */
    .avatar {
      width: 110px;
      margin-bottom: 15px;
      filter: drop-shadow(0 0 10px #6F874D);
      transition: transform 0.3s ease;
    }

    .avatar.cover-eyes {
      transform: rotate(10deg) scale(1.1);
      filter: grayscale(80%) drop-shadow(0 0 8px #6F874D);
    }

    h1 {
      font-size: 1.8rem;
      color: #2A3C1B;
      font-weight: 700;
      margin-bottom: 1rem;
    }

    /* Inputs */
    .form-control {
      border-radius: 25px;
      text-align: center;
      border: 2px solid #B3C69B;
      background: #f5f9f1;
      color: #2A3C1B;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #4C6B2C;
      box-shadow: 0 0 15px rgba(76, 107, 44, 0.4);
    }

    /* Botón verde institucional */
    .btn-green {
      background: linear-gradient(45deg, #4C6B2C, #2A3C1B);
      color: #fff;
      font-weight: bold;
      border-radius: 25px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border: none;
    }

    .btn-green:hover {
      transform: scale(1.05);
      box-shadow: 0 0 15px rgba(76, 107, 44, 0.6);
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
      color: #4C6B2C;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <?= view('partials/alert') ?>

  <div class="login-box">
    <img id="avatar" src="https://cdn-icons-png.flaticon.com/512/4213/4213482.png" class="avatar" alt="Avatar educativo" />
    <h1><i class="fas fa-leaf"></i> Bienvenido a la plataforma</h1>

    <form method="post" action="<?= base_url('authenticate') ?>" class="mt-4">
      <?= csrf_field() ?>
      <div class="form-group">
        <input type="email" name="email" class="form-control" value="<?= old('email') ?>" placeholder="Correo institucional" required>
      </div>

      <div class="form-group position-relative">
        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required
          onfocus="coverEyes()" onblur="uncoverEyes()" aria-label="Contraseña">
        <button type="button" class="toggle-password" onclick="togglePassword()" aria-label="Mostrar u ocultar contraseña">
          <i id="eye-icon" class="fas fa-eye"></i>
        </button>
      </div>

      <button type="submit" class="btn btn-green btn-block mt-3">
        <i class="fas fa-sign-in-alt"></i> Ingresar
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
