<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ICFES Kids - Inicio</title>
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
      background: linear-gradient(to top left, #FFD3E0, #C2F0FC);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      min-height: 100vh;
      padding: 40px 20px;
      text-align: center;
    }

    h1 {
      font-size: 2.8rem;
      color: #4A148C;
      margin-bottom: 10px;
    }

    h1 i {
      color: #FF4081;
      margin-right: 10px;
    }

    p {
      font-size: 1.3rem;
      color: #444;
      max-width: 600px;
      margin-bottom: 30px;
    }

    .main-image {
      width: 200px;
      margin-bottom: 30px;
    }

    .play-btn {
      background: #4A148C;
      color: white;
      font-size: 1.2rem;
      padding: 14px 30px;
      border-radius: 30px;
      text-decoration: none;
      transition: background 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 10px;
    }

    .play-btn:hover {
      background: #6A1B9A;
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

    .decor .star { top: 20%; left: 10%; width: 80px; }
    .decor .rocket { top: 70%; left: 80%; width: 100px; }
    .decor .book { top: 40%; left: 60%; width: 90px; }
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

  <img src="<?= base_url('img/icons/reading-kid.png') ?>" alt="Niño leyendo" class="main-image">

  <a href="<?= base_url('login') ?>" class="play-btn">
    <i class="fas fa-play"></i> Empezar Prueba
  </a>

</body>
</html>
