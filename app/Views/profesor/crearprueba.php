<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Generador de Prueba ICFES</title>

  <!-- Recursos -->
  <link href="<?= base_url('assets/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/partials/loader.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/partials/alert.css') ?>" rel="stylesheet">
  <script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>

  <style>
    :root { --verde-principal: #7c431c; }
    body { background-color: #f4f7f5; }
    h2, h5 { color: var(--verde-principal); }
    .btn-bloque { background-color: var(--verde-principal); color: #fff; border: none; }
    .btn-bloque:hover { background-color: #1e4818; }
    .btn-pregunta { background-color: #4CAF50; color: #fff; border: none; }
    .btn-pregunta:hover { background-color: #43a047; }
    .btn-guardar { background-color: #1cc88a; color: white; border: none; }
    .btn-guardar:hover { background-color: #17a673; }
    .bloque { border: 2px solid var(--verde-principal); padding: 15px; margin-bottom: 20px; border-radius: 10px; background-color: #fff; box-shadow: 0 0 8px rgba(42, 99, 34, 0.15); position: relative; }
    .pregunta { border: 1px solid #ddd; padding: 10px; border-radius: 6px; margin-bottom: 15px; border-left: 5px solid var(--verde-principal); background-color: #fafafa; position: relative; }
    .btn-eliminar-pregunta, .btn-eliminar-bloque { position: absolute; top: 10px; right: 10px; background-color: #dc3545; color: white; border: none; padding: 5px 8px; border-radius: 50%; }
    .btn-eliminar-pregunta:hover, .btn-eliminar-bloque:hover { background-color: #bb2d3b; }
    input[type="text"]:focus, textarea:focus, select:focus { border-color: var(--verde-principal); box-shadow: 0 0 5px rgba(42, 99, 34, 0.4); }
    select.form-select, select.form-control { border: 2px solid var(--verde-principal); border-radius: 6px; background-color: #fff; padding: 8px 12px; font-weight: 500; color: var(--verde-principal); }
    .input-group-text input[type="radio"] { margin-top: 0.35rem; }
  </style>
</head>
<body>

<div class="position-absolute" style="top: 20px; left: 20px;">
  <button class="btn btn-bloque" onclick="confirmarVolver()">
    <i class="fas fa-arrow-left me-1"></i> Volver
  </button>
</div>

<div class="container mt-3 pt-4">
  <h2 class="mb-4"><i class="fas fa-file-alt me-2"></i>Crear Prueba ICFES</h2>

  <!-- Campos principales -->
  <div class="row mb-3">
    <div class="col-md-6">
      <label for="nombrePrueba">Nombre de la Prueba:</label>
      <input type="text" id="nombrePrueba" class="form-control" placeholder="Ej: Comprensión lectora - Texto narrativo" required>
    </div>
    <div class="col-md-6">
      <label for="descripcionPrueba">Descripción:</label>
      <textarea id="descripcionPrueba" class="form-control" rows="1" placeholder="Breve descripción de la prueba" required></textarea>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-6">
      <label for="asignatura">Asignatura:</label>
      <select name="asignatura_id" id="asignatura" class="form-select" required>
        <option value="">Seleccione una asignatura</option>
        <?php foreach ($asignaturas as $asignatura): ?>
          <option value="<?= esc($asignatura['id']) ?>"><?= esc($asignatura['nombre']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-md-6">
      <label for="tipoBloque">Tipo de bloque:</label>
      <select id="tipoBloque" class="form-select">
        <option value="con-texto">🟢 Bloque con texto</option>
        <option value="solo-preguntas">🔵 Solo preguntas</option>
      </select>
    </div>
  </div>

  <form>
    <div id="bloques-container"></div>

    <div class="mt-4">
      <button type="button" class="btn btn-bloque me-2" onclick="agregarBloque()">
        <i class="fas fa-layer-group me-1"></i> Agregar Bloque
      </button>

      <button type="button" class="btn btn-secondary me-2" onclick="reiniciarFormulario()">
        <i class="fas fa-sync-alt me-1"></i> Reiniciar
      </button>

      <button type="button" class="btn btn-guardar" onclick="guardarPrueba()">
        <i class="fas fa-save me-1"></i> Guardar Prueba
      </button>
    </div>
  </form>
</div>

<!-- Templates -->
<template id="bloque-template">
  <div class="bloque">
    <button type="button" class="btn-eliminar-bloque"><i class="fas fa-times"></i></button>
    <h5>Bloque <span class="bloque-numero"></span></h5>
    <div class="textarea-lectura">
      <div class="mb-2">
        <label>Título de la Lectura:</label>
        <input type="text" class="form-control input-titulo" placeholder="Escribe un título para la lectura...">
      </div>
      <div class="mb-3">
        <label>Texto o Lectura:</label>
        <textarea class="form-control input-texto" rows="3" placeholder="Escribe el texto de lectura..."></textarea>
      </div>
    </div>
    <div class="preguntas-container"></div>
    <div class="mt-3">
      <button type="button" class="btn btn-pregunta agregar-pregunta">
        <i class="fas fa-question-circle me-1"></i> Agregar Pregunta
      </button>
    </div>
  </div>
</template>

<template id="pregunta-template">
  <div class="pregunta">
    <button type="button" class="btn-eliminar-pregunta"><i class="fas fa-times"></i></button>
    <label>Pregunta <span class="pregunta-numero"></span>:</label>
    <input type="text" class="form-control mb-2" placeholder="Escribe la pregunta...">
    <div class="row">
      <div class="col-md-6">
        <div class="input-group mb-2">
          <span class="input-group-text"><input type="radio" name="correcta__P__" value="a" required></span>
          <input type="text" class="form-control" placeholder="Opción A">
        </div>
        <div class="input-group mb-2">
          <span class="input-group-text"><input type="radio" name="correcta__P__" value="c" required></span>
          <input type="text" class="form-control" placeholder="Opción C">
        </div>
      </div>
      <div class="col-md-6">
        <div class="input-group mb-2">
          <span class="input-group-text"><input type="radio" name="correcta__P__" value="b" required></span>
          <input type="text" class="form-control" placeholder="Opción B">
        </div>
        <div class="input-group mb-2">
          <span class="input-group-text"><input type="radio" name="correcta__P__" value="d" required></span>
          <input type="text" class="form-control" placeholder="Opción D">
        </div>
      </div>
    </div>
    <div class="mt-2">
      <label>Justificación:</label>
      <textarea class="form-control" rows="2" placeholder="Escribe la justificación..."></textarea>
    </div>
  </div>
</template>

<script>
function confirmarVolver() {
  Swal.fire({
    title: '¿Estás seguro?',
    text: 'Si vuelves atrás, se perderá toda la información ingresada.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#7c431c',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, volver',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) window.history.back();
  });
}

let contadorBloques = 0, contadorPreguntasGlobal = 0;

function agregarBloque() {
  const asignatura = document.getElementById("asignatura").value;
  if (!asignatura) {
    Swal.fire({ icon: "warning", title: "Selecciona una asignatura", confirmButtonColor: "#7c431c" });
    return;
  }
  const tipo = document.getElementById("tipoBloque").value;
  const clon = document.getElementById("bloque-template").content.cloneNode(true);
  contadorBloques++;
  clon.querySelector(".bloque-numero").textContent = contadorBloques;
  const bloque = clon.querySelector(".bloque");
  bloque.setAttribute("data-tipo", tipo);
  if (tipo === "solo-preguntas") bloque.querySelector(".textarea-lectura").style.display = "none";
  bloque.querySelector(".agregar-pregunta").addEventListener("click", () => agregarPregunta(bloque));
  bloque.querySelector(".btn-eliminar-bloque").addEventListener("click", () => bloque.remove());
  document.getElementById("bloques-container").appendChild(clon);
  document.getElementById("asignatura").disabled = true;
}

function agregarPregunta(bloque) {
  const clon = document.getElementById("pregunta-template").content.cloneNode(true);
  contadorPreguntasGlobal++;
  clon.querySelector(".pregunta-numero").textContent = contadorPreguntasGlobal;
  clon.querySelectorAll("input[type=radio]").forEach(radio => radio.name = "correcta_" + contadorPreguntasGlobal);
  clon.querySelector(".btn-eliminar-pregunta").addEventListener("click", e => e.target.closest(".pregunta").remove());
  bloque.querySelector(".preguntas-container").appendChild(clon);
}

function reiniciarFormulario() {
  Swal.fire({
    title: '¿Reiniciar todo?', text: 'Se borrarán todos los bloques y preguntas.', icon: 'warning',
    showCancelButton: true, confirmButtonColor: '#7c431c', cancelButtonColor: '#d33', confirmButtonText: 'Sí, reiniciar'
  }).then(result => {
    if (result.isConfirmed) {
      document.getElementById("bloques-container").innerHTML = "";
      document.getElementById("asignatura").disabled = false;
      document.getElementById("asignatura").value = "";
      contadorBloques = 0; contadorPreguntasGlobal = 0;
    }
  });
}

function guardarPrueba() {
  const nombrePrueba = document.getElementById("nombrePrueba").value.trim();
  const descripcionPrueba = document.getElementById("descripcionPrueba").value.trim();
  if (!nombrePrueba || !descripcionPrueba) {
    Swal.fire({ icon: 'error', title: 'Datos incompletos', text: 'Completa el nombre y descripción de la prueba.', confirmButtonColor: '#7c431c' });
    return;
  }

  const bloques = document.querySelectorAll(".bloque");
  if (bloques.length === 0) {
    Swal.fire({ icon: "warning", title: "Agrega al menos un bloque", confirmButtonColor: "#7c431c" });
    return;
  }

  const resultado = []; let error = false;
  bloques.forEach((bloque, i) => {
    const tipo = bloque.getAttribute("data-tipo");
    let titulo = '', texto = '';
    if (tipo === 'con-texto') {
      titulo = bloque.querySelector(".input-titulo")?.value.trim();
      texto = bloque.querySelector(".input-texto")?.value.trim();
      if (!titulo || !texto) {
        Swal.fire({ icon: 'error', title: `Bloque ${i + 1}`, text: 'Completa el título y texto de la lectura.', confirmButtonColor: '#7c431c' });
        error = true; return;
      }
    }
    const preguntas = bloque.querySelectorAll(".pregunta");
    if (preguntas.length === 0) {
      Swal.fire({ icon: 'error', title: `Bloque ${i + 1}`, text: 'El bloque debe tener al menos una pregunta.', confirmButtonColor: '#7c431c' });
      error = true; return;
    }
    const preguntasData = [];
    preguntas.forEach((preguntaElem, j) => {
      const enunciado = preguntaElem.querySelector("input[type=text]").value.trim();
      const justificacion = preguntaElem.querySelector("textarea").value.trim();
      const opcionesInputs = preguntaElem.querySelectorAll(".input-group input[type=text]");
      const opciones = Array.from(opcionesInputs).map(i => i.value.trim());
      const correcta = preguntaElem.querySelector("input[type=radio]:checked")?.value;
      if (!enunciado || opciones.some(opt => !opt) || !correcta || !justificacion) {
        Swal.fire({ icon: 'error', title: `Bloque ${i + 1} - Pregunta ${j + 1}`, text: 'Completa todos los campos y selecciona la respuesta correcta.', confirmButtonColor: '#7c431c' });
        error = true; return;
      }
      preguntasData.push({ enunciado, opciones, correcta, justificacion });
    });
    if (!error) resultado.push({ tipo, titulo, texto, preguntas: preguntasData });
  });

  if (!error) {
    const asignatura_id = $("#asignatura").val();
    const resultadoFinal = { nombre: nombrePrueba, descripcion: descripcionPrueba, asignatura_id, bloques: resultado };
    console.log("JSON a enviar:", resultadoFinal);
   $.ajax({
  url: "<?= base_url('profesor/createexam/guardar-prueba') ?>",
  type: "POST",
  data: JSON.stringify(resultadoFinal),
  contentType: "application/json",
  success: function (response) {
    Swal.fire({
      icon: "success",
      title: "Prueba guardada correctamente",
      text: response.message || "Los datos se han guardado en la base de datos.",
      confirmButtonColor: "#7c431c"
    }).then(() => {
      window.location.href = "<?= base_url('profesor/home') ?>"; // ✅ Redirección
    });
  },
  error: function () {
    Swal.fire({
      icon: "error",
      title: "Error al guardar",
      text: "Hubo un problema al guardar la prueba.",
      confirmButtonColor: "#7c431c"
    });
  }
});

  }
}
</script>
</body>
</html>
