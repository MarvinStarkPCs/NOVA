<?= $this->extend('layouts/main') ?> 
<?= $this->section('content') ?>

<div class="card shadow mb-4">
  <div class="card-header py-3 bg-dark-blue d-flex justify-content-between align-items-center">
    <h6 class="m-0 fw-bold text-primary">Resultados</h6>
  </div>

  <!-- 🔎 Filtros -->
  <div class="card-body" id="filtroCollapse">
    <form class="row g-3 justify-content-center">
      <!-- Documento -->
      <div class="col-md-3">
        <label for="documento" class="form-label">
          <i class="fas fa-id-card me-1 text-primary"></i> Número de documento
        </label>
        <input type="number" id="documento" class="form-control" placeholder="Ingrese documento">
      </div>
    </form>

    <div class="row justify-content-center mt-3">
      <div class="col-md-2 text-center">
        <button type="button" class="btn btn-warning w-100" id="btnBuscar">
          <i class="fas fa-search me-1"></i> Buscar
        </button>
      </div>
      <div class="col-md-2 text-center">
        <button type="button" class="btn btn-secondary w-100" id="btnLimpiar">
          <i class="fas fa-broom me-1"></i> Limpiar
        </button>
      </div>
    </div>
  </div>

  <!-- 📊 Tabla -->
  <div class="card-body">
    <div class="table-responsive mt-4">
      <table id="dataTable3" class="table table-bordered" width="100%" cellspacing="0">
        <thead class="bg-primary text-white">
          <tr>
            <th>Documento</th>
            <th>Profesor</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="tablaResultados"></tbody>
      </table>
    </div>
  </div>
</div>

<!-- 📌 Modal Asignaturas -->
<div class="modal fade" id="modalAsignaturas" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-dark-blue text-white">
        <h5 class="modal-title">Asignaturas del Profesor</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form id="formAsignaturas">
        <div class="modal-body">
          <input type="hidden" id="profesor_id" name="profesor_id">

          <div class="form-group">
            <label for="asignaturaFormNew">Materias</label>
            <select class="form-control" id="asignaturaFormNew" name="asignatura_id[]" multiple="multiple">
              <?php foreach ($asignaturas as $asignatura): ?>
                <option value="<?= esc($asignatura['id']) ?>">
                  <?= esc($asignatura['nombre']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- 🎨 Estilos -->
<style>
  .form-label { font-weight: 600; color: #333; }
  .form-control { border-radius: 8px; height: 42px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); }
  .form-control:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.25rem rgba(78,115,223,.25);
  }
  .card.bg-dark-blue { background-color: #1c1f26 !important; color: #fff; }
</style>

<!-- 🔌 Script -->
<script>
$(document).ready(function() {
  // Inicializar Select2
  $('#asignaturaFormNew').select2({
    placeholder: "Selecciona materias",
    allowClear: true,
    width: '100%',
    dropdownParent: $('#modalAsignaturas')
  });

  let tabla = $('#dataTable3').DataTable();

  // 👉 Buscar profesor por documento
  $('#btnBuscar').on('click', function () {
    const documento = $('#documento').val().trim();
    if (!documento) {
      mostrarAlerta('warning','Por favor ingrese el número de documento.');
      return;
    }

    $.ajax({
      url: "./asignaciones/buscar",
      type: "POST",
      data: {
        documento: documento,
        <?= csrf_token() ?>: "<?= csrf_hash() ?>"
      },
      dataType: "json",
      success: function (data) {
        tabla.clear();

        if (data.length) {
          data.forEach(item => {
            tabla.row.add([
              item.documento,
              item.nombre_profesor + ' ' + item.apellido_profesor,
              item.email ?? '—',
              item.telefono ?? '—',
              `
                <button class="btn btn-sm btn-warning btnAsignaturas" 
                  data-id="${item.profesor_id}" 
                  data-asignaturas='${JSON.stringify(item.asignaturas_ids)}'>
                  <i class="fas fa-edit"></i> Asignaturas
                </button>
              `
            ]);
          });
        } else {
          mostrarAlerta('warning','No se encontraron resultados.');
        }
        tabla.draw();
      }
    });
  });

  // 👉 Limpiar búsqueda
  $('#btnLimpiar').on('click', function () {
    $('#documento').val('');
    tabla.clear().draw();
  });

  // 👉 Abrir modal y cargar asignaturas del profesor
  $(document).on('click', '.btnAsignaturas', function () {
    const profesorId = $(this).data('id');
    const asignaturas = JSON.parse($(this).attr('data-asignaturas')); // 👈 usar JSON.parse

    $('#profesor_id').val(profesorId);
    $('#asignaturaFormNew').val([]).trigger('change');

    if (asignaturas && asignaturas.length > 0) {
      const arrAsignaturas = asignaturas.map(id => id.toString().trim());
      $('#asignaturaFormNew').val(arrAsignaturas).trigger('change');
    }

    $('#modalAsignaturas').modal('show');
  });

  // 👉 Guardar cambios
  $('#formAsignaturas').on('submit', function (e) {
    e.preventDefault();

   $.ajax({
  url: "./asignaciones/guardarAsignaturas",
  type: "POST",
  data: $(this).serialize() + "&<?= csrf_token() ?>=<?= csrf_hash() ?>",
  success: function () {
    mostrarAlerta('success', 'Asignaturas actualizadas correctamente');
    $('#modalAsignaturas').modal('hide');

       setTimeout(() => {
      location.reload();
    }, 3000);

  },
  error: function () {
    mostrarAlerta('error', 'Error al guardar las asignaturas');
  }
});

  });
});
</script>

<?= $this->endSection() ?> 
