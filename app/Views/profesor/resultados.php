<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow mb-4">
  <div class="card-header py-3 bg-dark-blue d-flex justify-content-between align-items-center">
    <h6 class="m-0 fw-bold text-primary">Resultados</h6>
  </div>

  <!-- 🔎 Filtros -->
  <div class="card-body" id="filtroCollapse" style="display: block;">
    <form class="row g-3 justify-content-center">
      <!-- Documento -->
      <div class="col-md-3">
        <label for="documento" class="form-label">
          <i class="fas fa-id-card me-1 text-primary"></i> Número de documento
        </label>
        <input type="number" id="documento" class="form-control" placeholder="Ingrese documento">
      </div>
      <!-- Grado -->
      <div class="col-md-3">
        <label for="grado" class="form-label">
          <i class="fas fa-user-graduate me-1 text-success"></i> Grado
        </label>
        <select id="grado" class="form-control select2">
          <option value="">Selecciona...</option>
          <?php foreach ($grados as $grado): ?>
            <option value="<?= esc($grado['id']) ?>"><?= esc($grado['nombre']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <!-- Grupo -->
      <div class="col-md-3">
        <label for="grupo" class="form-label">
          <i class="fas fa-users me-1 text-warning"></i> Grupo
        </label>
        <select id="grupo" class="form-control select2">
          <option value="">-- Seleccione --</option>
        </select>
      </div>
      <!-- Jornada -->
      <div class="col-md-3">
        <label for="jornada" class="form-label">
          <i class="fas fa-clock me-1 text-danger"></i> Jornada
        </label>
        <select id="jornada" class="form-control select2">
          <option value="">-- Seleccione --</option>
          <?php foreach ($jornadas as $jornada): ?>
            <option value="<?= esc($jornada['id']) ?>"><?= esc($jornada['nombre']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </form>

    <div class="row justify-content-center mt-3">
      <div class="col-md-2 text-center">
        <button type="button" class="btn btn-primary w-100" id="btnBuscar">
          <i class="fas fa-search me-1"></i> Search
        </button>
      </div>
      <div class="col-md-2 text-center">
        <button type="button" class="btn btn-secondary w-100" id="btnLimpiar">
          <i class="fas fa-broom me-1"></i> Clean
        </button>
      </div>
    </div>
  </div>

  <!-- 📊 Tabla -->
  <div class="card-body">
    <div class="table-responsive mt-4">
      <table id="dataTable2" class="table table-bordered" width="100%" cellspacing="0">
        <thead class="bg-primary text-white">
          <tr>
            <th>Documento</th>
            <th>Estudiante</th>
            <th>Curso</th>
            <th>Jornada</th>
            <th>Prueba</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="tablaResultados">
          <!-- tbody vacío para que lo maneje dataTable2s -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- 🎨 Estilos -->
<style>
  .form-label {
    font-weight: 600;
    color: #333;
  }
  .form-control {
    border-radius: 8px;
    height: 42px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
  }
  .form-control:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.25rem rgba(78,115,223,.25);
  }
  .select2-container--default .select2-selection--single {
    border-radius: 8px;
    height: 42px;
    padding: 8px 12px;
    border: 1px solid #ced4da;
  }
  .card.bg-dark-blue {
    background-color: #1c1f26 !important;
    color: #fff;
  }
</style>

<!-- 🔌 Script -->
<script>
$(document).ready(function() {
  // 🔄 Restaurar datos al cargar la página
  const data = JSON.parse(localStorage.getItem('resultadosData'));
  const filtros = JSON.parse(localStorage.getItem('resultadosFiltros'));

  if (data && filtros) {
    // Restaurar filtros en inputs
    $('#documento').val(filtros.documento || '');
    $('#grado').val(filtros.grado || '').trigger('change');
    $('#grupo').val(filtros.grupo || '').trigger('change');
    $('#jornada').val(filtros.jornada || '').trigger('change');

    // Restaurar la tabla
    let tabla = $('#dataTable2').DataTable();
    tabla.clear();

    data.forEach(item => {
      tabla.row.add([
        item.documento,
        item.estudiante,
        item.curso,
        item.jornada,
        item.prueba_presentada,
        `<a href="./results/ver/${item.prueba_id}/${item.id_estudiante}" 
            class="btn btn-sm btn-primary" title="Ver prueba">
           <i class="fas fa-book-open"></i>
         </a>`
      ]);
    });

    tabla.draw();
  }

  // 👉 Buscar
  $('#btnBuscar').on('click', function () {
    const documento = $('#documento').val().trim();
    const grado = $('#grado').val();
    const grupo = $('#grupo').val();
    const jornada = $('#jornada').val();

    // 🔎 Validaciones
    if (documento && (grado || grupo || jornada)) {
      Swal.fire({
        icon: 'warning',
        title: 'Filtros inválidos',
        text: 'Debe buscar solo por documento o solo por grado/grupo/jornada, no ambos.',
      });
      return;
    }

    if (!documento && (!grado || !grupo || !jornada)) {
      Swal.fire({
        icon: 'warning',
        title: 'Faltan filtros',
        text: 'Ingrese un documento o seleccione grado, grupo y jornada.',
      });
      return;
    }

    // 👉 Si es por documento, limpiar selects
    if (documento) {
      $('#grado, #grupo, #jornada').val('').trigger('change');
    }

    // 👉 Si es por selects, limpiar documento
    if (!documento && (grado && grupo && jornada)) {
      $('#documento').val('');
    }

    // 🔥 Petición AJAX
    $.ajax({
      url: "./results/buscar",
      type: "POST",
      data: {
        documento: documento,
        grado: grado,
        grupo: grupo,
        jornada: jornada,
        <?= csrf_token() ?>: "<?= csrf_hash() ?>"
      },
      dataType: "json",
      success: function (data) {
        let tabla = $('#dataTable2').DataTable();
        tabla.clear();

        if (data.length) {
          data.forEach(item => {
            tabla.row.add([
              item.documento,
              item.estudiante,
              item.curso,
              item.jornada,
              item.prueba_presentada,
              `<a href="./results/ver/${item.prueba_id}/${item.id_estudiante}" 
                  class="btn btn-sm btn-primary" title="Ver prueba">
                 <i class="fas fa-book-open"></i>
               </a>`
            ]);
          });
        }

        tabla.draw();

        // 💾 Guardar en localStorage
        localStorage.setItem('resultadosData', JSON.stringify(data));
        localStorage.setItem('resultadosFiltros', JSON.stringify({ documento, grado, grupo, jornada }));
      }
    });
  });

  // 🧹 Limpiar filtros
  $('#btnLimpiar').on('click', function () {
    $('#documento, #grado, #grupo, #jornada').val('').trigger('change');
    let tabla = $('#dataTable2').DataTable();
    tabla.clear().draw();

    // 🗑️ Borrar localStorage
    localStorage.removeItem('resultadosData');
    localStorage.removeItem('resultadosFiltros');
  });

  // Dependencia grado -> grupo
  $('#grado').on('change', function() {
    cargarGruposPorGrado($(this).val());
  });

  function cargarGruposPorGrado(gradoId) {
    const grupoSelect = $('#grupo');
    grupoSelect.empty().append('<option value="">Cargando...</option>');

    if (!gradoId) {
      grupoSelect.html('<option value="">Selecciona un grado</option>');
      return;
    }

    $.ajax({
      url: "<?= base_url('profesor/usermanagement/showComboBox') ?>",
      type: "POST",
      data: {
        tabla: 'grupos',
        campo: 'grado_id',
        id: gradoId,
        <?= csrf_token() ?>: "<?= csrf_hash() ?>"
      },
      dataType: "json",
      success: function(data) {
        grupoSelect.empty().append('<option value="">Selecciona...</option>');
        if (data.length) {
          data.forEach(grupo => {
            grupoSelect.append(new Option(grupo.nombre, grupo.id));
          });
        } else {
          grupoSelect.append('<option value="">No hay grupos</option>');
        }
      }
    });
  }
});
</script>

<?= $this->endSection() ?>
