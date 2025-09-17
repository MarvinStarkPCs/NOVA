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
      background: linear-gradient(135deg, #2E1A47, #4B2C20, #F2A65A, #FFD580);
      background-size: 400% 400%;
      animation: gradientBG 12s ease infinite;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      min-height: 100vh;
      padding: 40px 20px;
      text-align: center;
      color: white;
    }

    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    h1 {
      font-size: 3rem;
      color: #FFD700;
      text-shadow: 0 0 10px #FFA500, 0 0 20px #FF8C00;
      margin-bottom: 10px;
    }

    h1 i {
      color: #FF8C00;
      margin-right: 10px;
    }

    p {
      font-size: 1.4rem;
      color: #FFEBCD;
      max-width: 650px;
      margin-bottom: 30px;
      text-shadow: 0 0 5px rgba(0,0,0,0.6);
    }

    .main-image {
      width: 250px;
      margin-bottom: 30px;
      border-radius: 20px;
      box-shadow: 0 0 20px rgba(255, 215, 0, 0.8);
    }

    .play-btn {
      background: linear-gradient(45deg, #FF8C00, #FFD700);
      color: #2E1A1A;
      font-size: 1.4rem;
      padding: 16px 36px;
      border-radius: 40px;
      text-decoration: none;
      font-weight: bold;
      transition: transform 0.2s ease, box-shadow 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      box-shadow: 0 4px 15px rgba(255, 140, 0, 0.6);
    }

    .play-btn:hover {
      transform: scale(1.08);
      box-shadow: 0 6px 20px rgba(255, 215, 0, 0.9);
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
      opacity: 0.15;
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

  <h1><i class="fas fa-child"></i> ¡Bienvenid@s!</h1>
  <p>Explora divertidas historias y demuestra cuánto comprendes. ¡Aquí aprender es una aventura!</p>

  <img src="<?= base_url('img/icons/logo.png') ?>" alt="Niño leyendo" class="main-image">

  <a href="<?= base_url('login') ?>" class="play-btn">
    <i class="fas fa-play"></i> Empezar Prueba
  </a>

</body>
</html>
