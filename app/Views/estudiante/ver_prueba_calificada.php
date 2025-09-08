<?php
// Calcular calificación
$total_preguntas = count($resultados);
$respuestas_correctas = 0;

// Para cada pregunta, calculamos si fue correcta
foreach($resultados as &$pregunta) {
    $pregunta['es_correcta'] = ($pregunta['opcion_elegida'] == $pregunta['opcion_correcta']) ? 1 : 0;
    if($pregunta['es_correcta'] == 1) {
        $respuestas_correctas++;
    }
}
unset($pregunta); // romper referencia

$calificacion = ($total_preguntas > 0) ? ($respuestas_correctas / $total_preguntas) * 100 : 0;
$calificacion = round($calificacion, 2);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Vista Estudiante - Prueba</title>
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2&family=Quicksand:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body { font-family: 'Quicksand', sans-serif; margin: 0; background: #f9fafb; color: #333; }
    nav { background: linear-gradient(90deg, #4A148C, #8771afff); color: white; padding: 15px 20px; font-size: 1.2rem; font-weight: bold; display: flex; align-items: center; gap: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.15);}
    .volver-container { max-width: 900px; margin: 15px auto 0 auto; padding: 0 20px; text-align: left; }
    .btn-volver { background: #6b7280; color: white; border: none; padding: 10px 16px; border-radius: 10px; cursor: pointer; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 8px; transition: 0.3s; }
    .btn-volver:hover { background: #4b5563; }
    .container { max-width: 900px; margin: 20px auto; background: #fff; padding: 25px; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    h2 { font-family: 'Baloo 2', cursive; margin-top: 30px; margin-bottom: 15px; }
    .calificacion { text-align: center; font-size: 1.2rem; margin-bottom: 20px; color: #2a6322; font-weight: bold; }
    .question { padding: 20px; margin: 15px 0; background: #fdfdfd; border: 1px solid #e0e0e0; border-radius: 14px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); }
    .lectura { background: #eef6ff; border-left: 6px solid #1a5aa2; }
    .pregunta p { font-weight: 600; margin-bottom: 10px; }
    .opcion { display: block; background: #f1f5f9; margin: 6px 0; padding: 10px; border-radius: 10px; cursor: default; transition: 0.2s; }
    .opcion.correcta { background: #d1fae5; border-left: 4px solid #10b981; }
    .opcion.incorrecta { background: #fee2e2; border-left: 4px solid #ef4444; }
    .opcion input { margin-right: 8px; }
    .justificacion { margin-top: 10px; padding: 10px; background: #fef3c7; border-left: 4px solid #f59e0b; border-radius: 8px; font-style: italic; color: #92400e; }
    footer { text-align: center; padding: 15px; font-size: 0.9rem; background: #f1f5f9; margin-top: 30px; border-top: 1px solid #e0e0e0; color: #666; }
  </style>
</head>
<body>
  <nav><i class="fas fa-clipboard-question"></i> Vista Estudiante - Prueba</nav>

  <div class="volver-container">
    <button type="button" class="btn-volver" onclick="window.history.back()">
      <i class="fas fa-arrow-left"></i> Volver
    </button>
  </div>

  <div class="container">
    <div class="calificacion">
      📊 Calificación: <?= $calificacion ?>% (<?= $respuestas_correctas ?> de <?= $total_preguntas ?> correctas)
    </div>

    <?php 
    $lectura_actual = null;
    foreach($resultados as $pregunta): 
        if(!empty($pregunta['lectura_id']) && $pregunta['lectura_id'] != $lectura_actual): 
            $lectura_actual = $pregunta['lectura_id']; ?>
            <div class="lectura question">
                <h4><?= $pregunta['lectura_titulo'] ?></h4>
                <p><?= $pregunta['lectura_contenido'] ?></p>
            </div>
        <?php endif; ?>

        <div class="question pregunta">
            <p><strong><?= $pregunta['pregunta_enunciado'] ?></strong></p>

            <?php foreach(['a','b','c','d'] as $op): 
                $clase = '';
                if($op == $pregunta['opcion_correcta']) $clase = 'correcta';
                if($op == $pregunta['opcion_elegida'] && $op != $pregunta['opcion_correcta']) $clase = 'incorrecta';
            ?>
                <label class="opcion <?= $clase ?>">
                    <input type="radio" disabled <?= ($op == $pregunta['opcion_elegida']) ? 'checked' : '' ?>>
                    <?= strtoupper($op) ?>) <?= $pregunta["opcion_$op"] ?>
                </label>
            <?php endforeach; ?>

            <?php if(!empty($pregunta['justificacion'])): ?>
                <div class="justificacion">
                    <?= $pregunta['justificacion'] ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

  </div>

  <footer>© 2025 NOVA - Aprende Jugando</footer>
</body>
</html>
