<!-- Modal de Agregar Usuario -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="<?= base_url('admin/usermanagement/add') ?>" method="post" class="modal-content" id="addUserForm">

      <?= csrf_field() ?>
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Agregar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputLogin">Usuario (Login)</label>
            <input type="text" name="login" id="inputLogin"
              class="form-control <?= session('errors-insert.login') ? 'is-invalid errors-insert' : '' ?>"
              value="<?= old('login') ?>" placeholder="Ej. jdoe">
            <div class="invalid-feedback"><?= session('errors-insert.login') ?></div>
          </div>
          <div class="form-group col-md-6">
            <label for="inputEmail">Correo Electrónico</label>
            <input type="email" name="email" id="inputEmail"
              class="form-control <?= session('errors-insert.email') ? 'is-invalid errors-insert' : '' ?>"
              value="<?= old('email') ?>" placeholder="Ej. correo@ejemplo.com">
            <div class="invalid-feedback"><?= session('errors-insert.email') ?></div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputName">Nombres</label>
            <input type="text" name="name" id="inputName"
              class="form-control <?= session('errors-insert.name') ? 'is-invalid errors-insert' : '' ?>"
              value="<?= old('name') ?>" placeholder="Nombres">
            <div class="invalid-feedback"><?= session('errors-insert.name') ?></div>
          </div>
          <div class="form-group col-md-6">
            <label for="inputLastName">Apellidos (opcional)</label>
            <input type="text" name="last_name" id="inputLastName"
              class="form-control <?= session('errors-insert.last_name') ? 'is-invalid errors-insert' : '' ?>"
              value="<?= old('last_name') ?>" placeholder="Apellidos">
            <div class="invalid-feedback"><?= session('errors-insert.last_name') ?></div>
          </div>
        </div>

        <div class="form-group">
          <label for="selectRole">Rol</label>
          <select name="role_id" id="selectRole"
            class="form-control <?= session('errors-insert.role_id') ? 'is-invalid errors-insert' : '' ?>">
            <option value="">Seleccione un rol</option>
            <?php foreach ($roles as $rol): ?>
              <option value="<?= $rol['id'] ?>" <?= old('role_id') == $rol['id'] ? 'selected' : '' ?>>
                <?= esc($rol['nombre']) ?>
              </option>
            <?php endforeach; ?>
          </select>
          <div class="invalid-feedback"><?= session('errors-insert.role_id') ?></div>
        </div>

        <!-- Campo dinámico de grupo -->
       <div class="form-row <?= old('role_id') == 3 ? '' : 'd-none' ?>" id="grupoGradoContainer">

  <!-- Select de Grado -->
  <div class="form-group col-md-6">
    <label for="selectGrado">Grado</label>
    <select name="grado_id" id="selectGrado"
      class="form-control <?= session('errors-insert.grado_id') ? 'is-invalid errors-insert' : '' ?>">
      <option value="">Seleccione un grado</option>
      <?php foreach ($grados as $grado): ?>
        <option value="<?= $grado['id'] ?>" <?= old('grado_id') == $grado['id'] ? 'selected' : '' ?>>
          <?= esc($grado['nombre']) ?>
        </option>
      <?php endforeach; ?>
    </select>
    <div class="invalid-feedback"><?= session('errors-insert.grado_id') ?></div>
  </div>

  <!-- Select de Grupo -->
  <div class="form-group col-md-6">
    <label for="selectGrupo">Grupo</label>
    <select name="grupo_id" id="selectGrupo"
      class="form-control <?= session('errors-insert.grupo_id') ? 'is-invalid errors-insert' : '' ?>">
      <option value="">Seleccione un grupo</option>
      <?php foreach ($grupos as $grupo): ?>
        <option value="<?= $grupo['id'] ?>" <?= old('grupo_id') == $grupo['id'] ? 'selected' : '' ?>>
          <?= esc($grupo['nombre']) ?>
        </option>
      <?php endforeach; ?>
    </select>
    <div class="invalid-feedback"><?= session('errors-insert.grupo_id') ?></div>
  </div>

</div>


        <div class="alert alert-info mt-3">
          La contraseña predeterminada es: <strong>SCOPECAPITAL2025</strong>.<br>
          El usuario deberá cambiarla al iniciar sesión.
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar Usuario</button>
      </div>
    </form>
  </div>
</div>

<!-- Script para mostrar el select si el rol es estudiante (id 3) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const selectRole = document.getElementById('selectRole');
  const grupoGradoContainer = document.getElementById('grupoGradoContainer');

  function toggleGrupoSelect() {
    if (selectRole.value === '3') {
      grupoGradoContainer.classList.remove('d-none');
    } else {
      grupoGradoContainer.classList.add('d-none');
    }
  }

  selectRole.addEventListener('change', toggleGrupoSelect);
  toggleGrupoSelect(); // Ejecutar en carga inicial

  // Mostrar modal si hay errores
  const form = document.getElementById('addUserForm');
  const inputWithError = form.querySelector('input.errors-insert, select.errors-insert');
  if (inputWithError) {
    $('#addUserModal').modal('show');
  }
});
</script>
