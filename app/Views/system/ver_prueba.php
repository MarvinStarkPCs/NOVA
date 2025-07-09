<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Resolver Prueba</title>
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2&family=Quicksand:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    * { box-sizing: border-box; }
    body, html {
      margin: 0; padding: 0;
      font-family: 'Quicksand', sans-serif;
      background: linear-gradient(to bottom right, #FFECD2, #FCB69F);
      color: #333;
    }
    nav {
      background: #ff7f50;
      color: white;
      padding: 1.2rem;
      text-align: center;
      font-size: 1.6rem;
      font-weight: bold;
      box-shadow: 0 3px 8px rgba(0,0,0,0.2);
    }
    .container {
      max-width: 1000px;
      margin: 2rem auto;
      padding: 1.5rem;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .lectura {
      background: #e0f7fa;
      border-left: 8px solid #26c6da;
      padding: 1rem;
      border-radius: 12px;
      margin-bottom: 1.5rem;
      box-shadow: inset 0 0 8px rgba(0,0,0,0.05);
    }
    .question {
      display: none;
      background: #fff8e1;
      padding: 1.2rem;
      margin-bottom: 1.5rem;
      border-left: 8px solid #fbc02d;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.08);
    }
    .question.active {
      display: block;
      animation: fadeIn 0.3s ease-in;
    }
    .question p {
      font-weight: 600;
      margin-bottom: 0.6rem;
    }
    .question label {
      display: block;
      background: #fff3e0;
      padding: 0.5rem 0.8rem;
      margin-bottom: 8px;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.2s ease;
    }
    .question label:hover { background: #ffe0b2; }
    .question input[type="radio"] { margin-right: 8px; cursor: pointer; }
    .pagination {
      display: flex;
      justify-content: center;
      gap: 1rem;
      margin: 2rem 0 1rem;
    }
    .pagination button {
      background: #ff7043;
      color: white;
      border: none;
      padding: 0.6rem 1.2rem;
      border-radius: 15px;
      font-size: 1.1rem;
      cursor: pointer;
      transition: background 0.2s ease;
    }
    .pagination button:hover { background: #e64a19; }
    #submitBtn {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: #43a047;
      color: white;
      padding: 1rem 1.8rem;
      font-size: 1.2rem;
      border: none;
      border-radius: 30px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.25);
      cursor: pointer;
    }
    footer {
      text-align: center;
      background: #ff7f50;
      color: white;
      padding: 1rem;
      border-radius: 0 0 20px 20px;
      margin-top: 2rem;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 768px) {
      #submitBtn {
        width: calc(100% - 40px);
        right: 20px;
        left: 20px;
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
<nav><i class="fas fa-clipboard-question"></i> Prueba Estudiantil</nav>
<form method="post" action="<?= base_url('estudiante/resolver/guardarRespuestas') ?>">
  <div class="container">
    <h2 style="color:#2a6322">📝 Comprensión de Lecturas</h2>
    <div id="bloqueLecturas">
      <?php
        $lecturaPreguntas = [];
        foreach ($lecturas_con_preguntas as $lectura) {
          $lecturaPreguntas[] = ['tipo' => 'lectura', 'titulo' => $lectura['titulo'], 'contenido' => $lectura['contenido']];
          foreach ($lectura['preguntas'] as $pregunta) {
            $lecturaPreguntas[] = [
              'tipo' => 'pregunta',
              'id' => $pregunta['pregunta_id'],
              'enunciado' => $pregunta['enunciado'],
              'A' => $pregunta['opcion_a'],
              'B' => $pregunta['opcion_b'],
              'C' => $pregunta['opcion_c'],
              'D' => $pregunta['opcion_d'],
            ];
          }
        }
        foreach ($lecturaPreguntas as $index => $item):
      ?>
        <?php if ($item['tipo'] === 'lectura'): ?>
          <div class="lectura question bloque1" data-index="<?= $index ?>">
            <h4><?= esc($item['titulo']) ?></h4>
            <p><?= nl2br(esc($item['contenido'])) ?></p>
          </div>
        <?php elseif ($item['tipo'] === 'pregunta'): ?>
          <div class="question pregunta bloque1" data-index="<?= $index ?>">
            <p><strong><?= esc($item['enunciado']) ?></strong></p>
            <?php foreach (['A', 'B', 'C', 'D'] as $opcion): ?>
              <label><input type="radio" name="respuesta[<?= $item['id'] ?>]" value="<?= $opcion ?>"> <?= esc($item[$opcion]) ?></label>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <h2 style="color:#1a5aa2">🔹 Preguntas Sueltas</h2>
    <div id="bloqueSueltas">
      <?php foreach ($preguntas_sueltas as $index => $pregunta): ?>
        <div class="question pregunta bloque2" data-index="<?= $index ?>">
          <p><strong><?= esc($pregunta['enunciado']) ?></strong></p>
          <?php foreach (['A', 'B', 'C', 'D'] as $opcion): ?>
            <label><input type="radio" name="respuesta[<?= $pregunta['id'] ?>]" value="<?= $opcion ?>"> <?= esc($pregunta['opcion_' . strtolower($opcion)]) ?></label>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="pagination">
      <button type="button" onclick="cambiarPagina(-1)"><i class="fas fa-arrow-left"></i> Anterior</button>
      <button type="button" onclick="cambiarPagina(1)">Siguiente <i class="fas fa-arrow-right"></i></button>
    </div>

    <button type="submit" id="submitBtn"><i class="fas fa-paper-plane"></i> Entregar</button>
  </div>
</form>
<footer>© 2025 Marvin StarkPCS - Aprende Jugando</footer>
<script>
  const preguntasPorPagina = 10;
  let paginaActual = 0;
  const preguntasLectura = document.querySelectorAll('.bloque1.pregunta');
  const preguntasSueltas = document.querySelectorAll('.bloque2.pregunta');
  const todasPreguntas = [...preguntasLectura, ...preguntasSueltas];
  function mostrarPagina() {
    const preguntas = document.querySelectorAll('.question');
    preguntas.forEach(q => q.classList.remove('active'));
    let contador = 0;
    for (let i = 0; i < todasPreguntas.length; i++) {
      contador++;
      const inicio = paginaActual * preguntasPorPagina;
      const fin = inicio + preguntasPorPagina;
      if (contador > inicio && contador <= fin) {
        const actual = todasPreguntas[i];
        actual.classList.add('active');
        const prev = actual.previousElementSibling;
        if (prev && prev.classList.contains('lectura')) {
          prev.classList.add('active');
        }
      }
    }
  }
  function cambiarPagina(offset) {
    const total = todasPreguntas.length;
    const totalPaginas = Math.ceil(total / preguntasPorPagina);
    paginaActual = Math.max(0, Math.min(paginaActual + offset, totalPaginas - 1));
    mostrarPagina();
  }
  mostrarPagina();
</script>
</body>
</html>
