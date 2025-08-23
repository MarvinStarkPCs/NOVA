<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Vista Estudiante - Prueba</title>
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2&family=Quicksand:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      font-family: 'Quicksand', sans-serif;
      margin: 0;
      background: #f9fafb;
      color: #333;
    }
    nav {
      background: linear-gradient(90deg, #1a5aa2, #2a6322);
      color: white;
      padding: 15px 20px;
      font-size: 1.2rem;
      font-weight: bold;
      display: flex;
      align-items: center;
      gap: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    }
    .volver-container {
      max-width: 900px;
      margin: 15px auto 0 auto;
      padding: 0 20px;
      text-align: left;
    }
    .btn-volver {
      background: #6b7280;
      color: white;
      border: none;
      padding: 10px 16px;
      border-radius: 10px;
      cursor: pointer;
      font-size: 0.95rem;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: 0.3s;
    }
    .btn-volver:hover {
      background: #4b5563;
    }
    .container {
      max-width: 900px;
      margin: 20px auto;
      background: #fff;
      padding: 25px;
      border-radius: 16px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    h2 {
      font-family: 'Baloo 2', cursive;
      margin-top: 30px;
      margin-bottom: 15px;
    }
    .question {
      padding: 20px;
      margin: 15px 0;
      background: #fdfdfd;
      border: 1px solid #e0e0e0;
      border-radius: 14px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .lectura {
      background: #eef6ff;
      border-left: 6px solid #1a5aa2;
    }
    .pregunta p {
      font-weight: 600;
      margin-bottom: 10px;
    }
    .opcion {
      display: block;
      background: #f1f5f9;
      margin: 6px 0;
      padding: 10px;
      border-radius: 10px;
      cursor: pointer;
      transition: 0.2s;
    }
    .opcion:hover {
      background: #dbeafe;
    }
    .opcion input {
      margin-right: 8px;
    }
    .btn-entregar {
      background: #2a6322;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 12px;
      font-size: 1rem;
      cursor: pointer;
      display: block;
      margin: 30px auto 0 auto;
      transition: 0.3s;
    }
    .btn-entregar:hover {
      background: #1b4212;
    }
    footer {
      text-align: center;
      padding: 15px;
      font-size: 0.9rem;
      background: #f1f5f9;
      margin-top: 30px;
      border-top: 1px solid #e0e0e0;
      color: #666;
    }
  </style>
</head>
<body>
<nav><i class="fas fa-clipboard-question"></i> Vista Estudiante - Prueba</nav>

<div class="volver-container">
  <button type="button" class="btn-volver" onclick="window.history.back()">
    <i class="fas fa-arrow-left"></i> Volver
  </button>
</div>

<form method="POST" action="<?= base_url('estudiante/entregar_prueba') ?>">
  <div class="container">
    <h2 style="color:#2a6322">📝 Comprensión de Lecturas</h2>
    <div id="bloqueLecturas">
      <?php foreach ($lecturas_con_preguntas as $lectura): ?>
        <div class="lectura question">
          <h4><?= esc($lectura['titulo']) ?></h4>
          <p><?= nl2br(esc($lectura['contenido'])) ?></p>
        </div>

        <?php if (isset($lectura['preguntas'])): ?>
          <?php foreach ($lectura['preguntas'] as $pregunta): ?>
            <div class="question pregunta">
              <p><strong><?= esc($pregunta['enunciado']) ?></strong></p>
              <?php foreach (['a','b','c','d'] as $op): ?>
                <label class="opcion">
                  <input type="radio" name="respuesta[<?= $pregunta['pregunta_id'] ?>]" value="<?= $op ?>">
                  <?= strtoupper($op) ?>) <?= esc($pregunta['opcion_'.$op]) ?>
                </label>
              <?php endforeach; ?>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <h2 style="color:#1a5aa2">🔹 Preguntas Sueltas</h2>
    <div id="bloqueSueltas">
      <?php foreach ($preguntas_sueltas as $pregunta): ?>
        <div class="question pregunta">
          <p><strong><?= esc($pregunta['enunciado']) ?></strong></p>
          <?php foreach (['a','b','c','d'] as $op): ?>
            <label class="opcion">
              <input type="radio" name="respuesta[<?= $pregunta['id'] ?>]" value="<?= $op ?>">
              <?= strtoupper($op) ?>) <?= esc($pregunta['opcion_'.$op]) ?>
            </label>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>

    <button type="submit" class="btn-entregar">📤 Entregar prueba</button>
  </div>
</form>

<footer>© 2025 NOVA - Aprende Jugando</footer>

</body>
</html>
