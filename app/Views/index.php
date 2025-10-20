<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Luminia</title>
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Baloo 2', cursive;
      background: linear-gradient(135deg, #B3C69B, #A2B887, #E6EAD5, #C9DABF);
      background-size: 400% 400%;
      animation: gradientBG 12s ease infinite;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      min-height: 100vh;
      padding: 40px 20px;
      text-align: center;
      color: #2E2E2E;
      position: relative;
      overflow: hidden;
    }

    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .logos-container {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 40px;
      margin-bottom: 25px;
      flex-wrap: wrap;
    }

    .logos-container img {
      height: 80px;
      border-radius: 10px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      background: #fff;
      padding: 5px;
    }

    .logos-container img:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
    }

    h1 {
      font-size: 3rem;
      color: #2E4029;
      text-shadow: 0 0 8px rgba(0,0,0,0.1);
      margin-bottom: 10px;
    }

    h1 i {
      color: #6D8A4A;
      margin-right: 10px;
    }

    p {
      font-size: 1.4rem;
      color: #3A4B2E;
      max-width: 650px;
      margin-bottom: 30px;
      text-shadow: 0 0 4px rgba(255,255,255,0.5);
    }

    .main-image {
      width: 250px;
      margin-bottom: 30px;
      border-radius: 20px;
      box-shadow: 0 0 20px rgba(109, 138, 74, 0.6);
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    .play-btn {
      background: linear-gradient(45deg, #6D8A4A, #B3C69B);
      color: #fff;
      font-size: 1.4rem;
      padding: 16px 36px;
      border-radius: 40px;
      text-decoration: none;
      font-weight: bold;
      transition: transform 0.2s ease, box-shadow 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      box-shadow: 0 4px 15px rgba(109, 138, 74, 0.6);
    }

    .play-btn:hover {
      transform: scale(1.08);
      box-shadow: 0 6px 20px rgba(74, 94, 45, 0.8);
    }

    .decor {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      overflow: hidden;
      z-index: -1;
    }

    .decor img {
      position: absolute;
      opacity: 0.1;
    }

    .decor .star { top: 15%; left: 8%; width: 100px; }
    .decor .rocket { top: 70%; left: 75%; width: 120px; }
    .decor .book { top: 40%; left: 55%; width: 110px; }
  </style>
</head>

<body>

  <div class="decor">
    <img src="<?= base_url('img/icons/star.png') ?>" class="star" alt="Estrella">
    <img src="<?= base_url('img/icons/rocket.png') ?>" class="rocket" alt="Cohete">
    <img src="<?= base_url('img/icons/book.png') ?>" class="book" alt="Libro">
  </div>

  <!-- Logos superiores -->
  <div class="logos-container">
    <img src="https://www.sena.edu.co/es-co/Noticias/PublishingImages/Comunicado15marzo.jpg" alt="Logo SENA">
    <img src="https://scontent.feoh2-1.fna.fbcdn.net/v/t39.30808-6/244633764_10157257316813039_4235800969585275176_n.png?_nc_cat=104&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeHRr3ZkmSPatN9r9Ea-bYx3FOWLWIw7TJkU5YtYjDtMmdp-0Ated1QMkOqpppKa4uNiPyiPgu4GFgaAQYbdY326&_nc_ohc=uxdNPCwCMNUQ7kNvwEU91uL&_nc_oc=AdlBTylMpvAVfZLWP6bwHIb-OA-giMcxsY6GbD3chrCnF_K_bskU-MvCzKCXaKW9bCglKsamDIVR4ieVQWUy75Cg&_nc_zt=23&_nc_ht=scontent.feoh2-1.fna&_nc_gid=KFeMmGm5Y5pRXbq4jFXTFw&oh=00_Aff7hUjwTnS5iLh-nsBv1v3nnhozNeYm0mJdxYmpvM6b_g&oe=68F883A7" alt="Logo Industrial">
  </div>

  <h1><i class="fas fa-child"></i> ¡Bienvenid@s a Luminia!</h1>
  <p>Explora divertidas historias y demuestra cuánto comprendes.<br>  
  ¡Aquí aprender es una aventura verde y luminosa!</p>

  <img src="<?= base_url('img/icons/logo.png') ?>" alt="Niño leyendo" class="main-image">

  <a href="<?= base_url('login') ?>" class="play-btn">
    <i class="fas fa-play"></i> Empezar Prueba
  </a>

</body>
</html>
