<!-- Modal de Agregar Usuario -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="./usermanagement/add" method="post" id="addUserForm">
        <?= csrf_field() ?>
        <div class="modal-header">
          <h5 class="modal-title">Agregar Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <!-- NAV TABS -->
          <ul class="nav nav-tabs" id="userTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#client" role="tab">Información Básica</a>
            </li>
            <li class="nav-item d-none" id="tabMatricula">
              <a class="nav-link" data-toggle="tab" href="#matricula" role="tab">Matrícula</a>
            </li>
            <li class="nav-item d-none" id="tabAsignatura">
              <a class="nav-link" data-toggle="tab" href="#asignatura" role="tab">Asignar Materia</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#system" role="tab">Sistema</a>
            </li>
          </ul>

          <div class="tab-content pt-3">

            <!-- TAB: Información Básica -->
            <div class="tab-pane fade show active" id="client" role="tabpanel">
              <h5 class="text-primary">Información Básica</h5>
              <div class="row">
                <!-- Nombre -->
                <div class="form-group col-md-4">
                  <label for="inputName">Nombres</label>
                  <input type="text" class="form-control <?= session('errors-insert.name') ? 'is-invalid errors-insert' : '' ?>"
                    id="inputName" name="name" value="<?= esc(old('name')) ?>" placeholder="Nombre">
                  <?= session('errors-insert.name') ? '<div class="invalid-feedback">' . esc(session('errors-insert.name')) . '</div>' : '' ?>
                </div>

                <div class="form-group col-md-4">
                  <label for="inputLastName">Apellidos</label>
                  <input type="text" class="form-control <?= session('errors-insert.last_name') ? 'is-invalid errors-insert' : '' ?>"
                    id="inputLastName" name="last_name" value="<?= esc(old('last_name')) ?>" placeholder="Apellidos">
                  <?= session('errors-insert.last_name') ? '<div class="invalid-feedback">' . esc(session('errors-insert.last_name')) . '</div>' : '' ?>
                </div>

                <!-- Documento -->
                <div class="form-group col-md-4">
                  <label for="inputDocumento">Documento</label>
                  <input type="number" class="form-control <?= session('errors-insert.documento') ? 'is-invalid errors-insert' : '' ?>"
                    id="inputDocumento" name="documento" value="<?= esc(old('documento')) ?>" placeholder="Documento">
                  <?= session('errors-insert.documento') ? '<div class="invalid-feedback">' . esc(session('errors-insert.documento')) . '</div>' : '' ?>
                </div>

                <!-- Email -->
                <div class="form-group col-md-4">
                  <label for="inputEmail">Correo</label>
                  <input type="email" class="form-control <?= session('errors-insert.email') ? 'is-invalid errors-insert' : '' ?>"
                    id="inputEmail" name="email" value="<?= esc(old('email')) ?>" placeholder="Email">
                  <?= session('errors-insert.email') ? '<div class="invalid-feedback">' . esc(session('errors-insert.email')) . '</div>' : '' ?>
                </div>

                <!-- Teléfono -->
                <div class="form-group col-md-4">
                  <label for="inputTelefono">Teléfono</label>
                  <input type="text" class="form-control <?= session('errors-insert.telefono') ? 'is-invalid errors-insert' : '' ?>"
                    id="inputTelefono" name="telefono" value="<?= esc(old('telefono')) ?>" placeholder="Teléfono">
                  <?= session('errors-insert.telefono') ? '<div class="invalid-feedback">' . esc(session('errors-insert.telefono')) . '</div>' : '' ?>
                </div>

                <!-- Dirección -->
                <div class="form-group col-md-4">
                  <label for="inputDireccion">Dirección</label>
                  <input type="text" class="form-control <?= session('errors-insert.direccion') ? 'is-invalid errors-insert' : '' ?>"
                    id="inputDireccion" name="direccion" value="<?= esc(old('direccion')) ?>" placeholder="Dirección">
                  <?= session('errors-insert.direccion') ? '<div class="invalid-feedback">' . esc(session('errors-insert.direccion')) . '</div>' : '' ?>
                </div>

                <!-- Género -->
                <div class="form-group col-md-4">
                  <label for="inputGenero">Género</label>
                  <select class="form-control <?= session('errors-insert.genero') ? 'is-invalid errors-insert' : '' ?>"
                    id="inputGenero" name="genero">
                    <option value="">Selecciona...</option>
                    <option value="MASCULINO" <?= old('genero') == 'MASCULINO' ? 'selected' : '' ?>>Masculino</option>
                    <option value="FEMENINO" <?= old('genero') == 'FEMENINO' ? 'selected' : '' ?>>Femenino</option>
                  </select>
                  <?= session('errors-insert.genero') ? '<div class="invalid-feedback">' . esc(session('errors-insert.genero')) . '</div>' : '' ?>
                </div>

                <!-- Fecha de nacimiento -->
                <div class="form-group col-md-4">
                  <label for="inputFechaNacimiento">Fecha de Nacimiento</label>
                  <input type="date" class="form-control <?= session('errors-insert.fecha_nacimiento') ? 'is-invalid errors-insert' : '' ?>"
                    id="inputFechaNacimiento" name="fecha_nacimiento" value="<?= esc(old('fecha_nacimiento')) ?>">
                  <?= session('errors-insert.fecha_nacimiento') ? '<div class="invalid-feedback">' . esc(session('errors-insert.fecha_nacimiento')) . '</div>' : '' ?>
                </div>

                <!-- Tipo de usuario -->
                <div class="form-group col-md-4">
                  <label for="inputTipoUsuario">Tipo de Usuario</label>
                  <select class="form-control <?= session('errors-insert.role_id') ? 'is-invalid errors-insert' : '' ?>" id="inputTipoUsuario" name="role_id">
                    <option value="">Seleccione un rol</option>
                    <?php foreach ($roles as $role): ?>
                      <option value="<?= esc($role['id']) ?>" <?= old('role_id') == $role['id'] ? 'selected' : '' ?>>
                        <?= esc($role['nombre']) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                  <?= session('errors-insert.role_id') ? '<div class="invalid-feedback">' . esc(session('errors-insert.role_id')) . '</div>' : '' ?>
                </div>

              </div>
              <div class="text-right">
                <button type="button" class="btn btn-primary next-tab">Siguiente</button>
              </div>
            </div>

            <!-- TAB: Matrícula -->
            <div class="tab-pane fade" id="matricula" role="tabpanel">
              <h5 class="text-primary">Datos de Matrícula</h5>
              <div class="row" id="matriculaFields">

                <!-- Jornada -->
                <div class="form-group col-md-4">
                  <label for="jornada">Jornada</label>
                  <select class="form-control select2 <?= session('errors-insert.jornada') ? 'is-invalid errors-insert' : '' ?>" id="jornada" name="jornada">
                    <option value="">Seleccione Jornada</option>
                    <?php foreach ($jornadas as $jornada): ?>
                      <option value="<?= esc($jornada['id']) ?>" <?= old('jornada') == $jornada['id'] ? 'selected' : '' ?>>
                        <?= esc($jornada['nombre']) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                  <?= session('errors-insert.jornada') ? '<div class="invalid-feedback">' . esc(session('errors-insert.jornada')) . '</div>' : '' ?>
                </div>

                <!-- Grado -->
                <div class="form-group col-md-4">
                  <label for="gradoFormNew">Grado</label>
                  <select class="form-control select2 <?= session('errors-insert.grado_id') ? 'is-invalid errors-insert' : '' ?>" id="gradoFormNew" name="grado_id">
                    <option value="">Selecciona...</option>
                    <?php foreach ($grados as $grado): ?>
                      <option value="<?= esc($grado['id']) ?>" <?= old('grado_id') == $grado['id'] ? 'selected' : '' ?>>
                        <?= esc($grado['nombre']) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                  <?= session('errors-insert.grado_id') ? '<div class="invalid-feedback">' . esc(session('errors-insert.grado_id')) . '</div>' : '' ?>
                </div>

                <!-- Grupo -->
                <div class="form-group col-md-4">
                  <label for="grupoFormNew">Grupo</label>
                  <select class="form-control select2 <?= session('errors-insert.grupo_id') ? 'is-invalid errors-insert' : '' ?>" id="grupoFormNew" name="grupo_id">
                    <option value="">Selecciona...</option>
                  </select>
                  <?= session('errors-insert.grupo_id') ? '<div class="invalid-feedback">' . esc(session('errors-insert.grupo_id')) . '</div>' : '' ?>
                </div>

                <!-- Fecha -->
                <div class="form-group col-md-4">
                  <label for="fecha_matricula">Fecha de Matrícula</label>
                  <input type="date" class="form-control <?= session('errors-insert.fecha_matricula') ? 'is-invalid errors-insert' : '' ?>" id="fecha_matricula" name="fecha_matricula" value="<?= esc(old('fecha_matricula')) ?>">
                  <?= session('errors-insert.fecha_matricula') ? '<div class="invalid-feedback">' . esc(session('errors-insert.fecha_matricula')) . '</div>' : '' ?>
                </div>

              </div>

              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary prev-tab">Anterior</button>
                <button type="button" class="btn btn-primary next-tab">Siguiente</button>
              </div>
            </div>


            <!-- TAB: Asignar Materia -->
            <div class="tab-pane fade" id="asignatura" role="tabpanel">
              <h5 class="text-primary">Asignar Materia</h5>
              <div class="row">


                <div class="form-group col-md-6">
                  <label for="asignaturaFormNew">Materias</label>
                  <select class="form-control <?= session('errors-insert.asignatura_id') ? 'is-invalid errors-insert' : '' ?>" id="asignaturaFormNew" name="asignatura_id[]" multiple="multiple">
                    <?php foreach ($asignaturas as $asignatura): ?>
                      <option value="<?= esc($asignatura['id']) ?>">
                        <?= esc($asignatura['nombre']) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                  <?= session('errors-insert.asignatura_id') ? '<div class="invalid-feedback">' . esc(session('errors-insert.asignatura_id')) . '</div>' : '' ?>
                </div>


              </div>
              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary prev-tab">Anterior</button>
                <button type="button" class="btn btn-primary next-tab">Siguiente</button>

              </div>
            </div>

            <!-- TAB: Sistema -->
            <div class="tab-pane fade" id="system" role="tabpanel">
              <h5 class="text-primary">Acceso al Sistema</h5>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="selectStatus">Estado del Sistema</label>
                  <select class="form-control" id="selectStatus" name="status">
                    <option value="activo" <?= old('status') == 'activo' ? 'selected' : '' ?>>Activo</option>
                    <option value="inactivo" <?= old('status') == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                  </select>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary prev-tab">Anterior</button>
                <button type="submit" class="btn btn-success">Guardar Usuario</button>
              </div>
            </div>

          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  // Activa Select2 con soporte de etiquetas
  $(document).ready(function() {
    $('#asignaturaFormNew').select2({
      placeholder: "Selecciona materias",
      allowClear: true,
      width: '100%'
    });
  });

  document.addEventListener('DOMContentLoaded', function() {
    const selectRol = document.getElementById('inputTipoUsuario');
    const matriculaTab = document.getElementById('tabMatricula');
    const asignarMaTab = document.getElementById('tabAsignatura');
    const infouser = document.getElementById('client');
    const form = document.getElementById('addUserForm');
    const selectasignatura = document.getElementById('asignaturaFormNew');
    // Mostrar/ocultar pestañas según rol
    function mostrarTabPorRol(selectedValue) {
      if (selectedValue === "1") { // Profesor
        asignarMaTab.classList.remove('d-none');
        matriculaTab.classList.add('d-none');

      } else if (selectedValue === "2") { // Estudiante
        matriculaTab.classList.remove('d-none');
        asignarMaTab.classList.add('d-none');
      } else if (selectedValue === "3") { // Admin u otros
        matriculaTab.classList.add('d-none');
        asignarMaTab.classList.add('d-none');
      }
    }

    // Ejecutar al cambiar el select
    selectRol.addEventListener('change', function() {
      mostrarTabPorRol(this.value);
    });

    // Cambiar pestaña de forma controlada según rol
    function irSegunRol() {
      const rol = selectRol.value;

      // Primero quitamos clases activas
      document.querySelectorAll('.nav-tabs .nav-link').forEach(tab => tab.classList.remove('active'));
      document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active', 'show'));

      if (rol === "1") {
        // Profesor → Asignar Materia
        document.querySelector('#tabAsignatura a').classList.add('active');
        document.querySelector('#asignatura').classList.add('active', 'show');
      } else if (rol === "2") {
        // Estudiante → Matrícula
        document.querySelector('#tabMatricula a').classList.add('active');
        document.querySelector('#matricula').classList.add('active', 'show');
      } else {
        // Admin u otro → Sistema
        document.querySelector('a[href="#client"]').classList.add('active');
        document.querySelector('#client').classList.add('active', 'show');
      }
    }

    // Botón "Siguiente" en la pestaña de cliente
    const btnNextClient = document.querySelector('#client .next-tab');
    if (btnNextClient) {
      btnNextClient.addEventListener('click', irSegunRol);
    }

    // Botones navegación prev/next
    function cambiarPestaña(direccion) {
      const tabs = Array.from(document.querySelectorAll('.nav-tabs .nav-item:not(.d-none) .nav-link'));
      const tabPanes = Array.from(document.querySelectorAll('.tab-pane'));
      const actual = tabs.findIndex(tab => tab.classList.contains('active'));
      let destinoIndex = (direccion === 'next') ? actual + 1 : actual - 1;

      if (destinoIndex >= 0 && destinoIndex < tabs.length) {
        tabs.forEach(tab => tab.classList.remove('active'));
        tabPanes.forEach(pane => pane.classList.remove('active', 'show'));

        tabs[destinoIndex].classList.add('active');
        const destinoId = tabs[destinoIndex].getAttribute('href');
        document.querySelector(destinoId).classList.add('active', 'show');
      }
    }

    document.querySelectorAll('.prev-tab').forEach(btn =>
      btn.addEventListener('click', () => cambiarPestaña('prev'))
    );
    document.querySelectorAll('#matricula .next-tab').forEach(btn =>
      btn.addEventListener('click', () => cambiarPestaña('next'))
    );

    // Cargar grupos dinámicamente por grado
    function cargarGruposPorGrado(gradoId) {
      const grupoSelect = $('#grupoFormNew');
      grupoSelect.empty().append('<option value="">Cargando...</option>');

      if (!gradoId || gradoId.trim() === '') {
        grupoSelect.html('<option value="">Selecciona un grado</option>');
        return;
      }

      $.ajax({
        url: "<?= base_url('admin/usermanagement/showComboBox') ?>",
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

    $('#gradoFormNew').on('change', function() {
      cargarGruposPorGrado($(this).val());
    });

    // Mostrar modal si hay errores de validación
    if (form && form.querySelector('.is-invalid')) {
      $('#addUserModal').modal('show');
      mostrarAlerta('info', 'Revise los campos requeridos en ROJO (Información Básica).');

      console.log('Modal abierto por errores de validación.');

      // Reabrir la pestaña correcta según rol
      mostrarTabPorRol(selectRol.value);
      irSegunRol();
    }

    // Al cargar vista, inicializar tabs según el valor del rol
    mostrarTabPorRol(selectRol.value);
  });
</script>