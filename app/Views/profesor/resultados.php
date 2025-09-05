<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow mb-4">
  <div class="card-header py-3 bg-dark-blue d-flex justify-content-between align-items-center">
    <h6 class="m-0 fw-bold text-primary">PQRS</h6>
    <div>
      <button class="btn btn-success btn-sm">
        <i class="fas fa-file-excel"></i> Export to Excel
      </button>
      <button class="btn btn-sm btn-outline-light" type="button" id="toggleFiltros">
        <i class="fas fa-sliders-h me-1"></i> Hide filters
      </button>
    </div>
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
          <option value="" disabled selected>-- Seleccione --</option>
          <option>6°</option>
          <option>7°</option>
          <option>8°</option>
          <option>9°</option>
          <option>10°</option>
          <option>11°</option>
        </select>
      </div>
      <!-- Grupo -->
      <div class="col-md-3">
        <label for="grupo" class="form-label">
          <i class="fas fa-users me-1 text-warning"></i> Grupo
        </label>
        <select id="grupo" class="form-control select2">
          <option value="" disabled selected>-- Seleccione --</option>
          <option>A</option>
          <option>B</option>
          <option>C</option>
        </select>
      </div>
      <!-- Jornada -->
      <div class="col-md-3">
        <label for="jornada" class="form-label">
          <i class="fas fa-clock me-1 text-danger"></i> Jornada
        </label>
        <select id="jornada" class="form-control select2">
          <option value="" disabled selected>-- Seleccione --</option>
          <option>Mañana</option>
          <option>Tarde</option>
          <option>Noche</option>
        </select>
      </div>
    </form>

    <div class="row justify-content-center mt-3">
      <div class="col-md-2 text-center">
        <button type="button" class="btn btn-warning w-100">
          <i class="fas fa-search me-1"></i> Search
        </button>
      </div>
      <div class="col-md-2 text-center">
        <button type="button" class="btn btn-secondary w-100">
          <i class="fas fa-broom me-1"></i> Clean
        </button>
      </div>
    </div>
  </div>

  <!-- 📊 Tabla -->
  <div class="card-body">
    <div class="table-responsive mt-4">
      <table class="table table-bordered" width="100%">
        <thead class="bg-primary text-white">
          <tr>
            <th>Unique Code</th>
            <th>User Name</th>
            <th>Type</th>
            <th>Status</th>
            <th>Opening Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="tablaResultados">
          <tr>
            <td>PQRS001</td>
            <td>usuario1@mail.com</td>
            <td>Queja</td>
            <td>Abierto</td>
            <td>2025-09-01</td>
            <td>
             
              <a href="<?= base_url('pruebas/ver/1') ?>" class="btn btn-sm btn-primary" title="Ver prueba">
                <i class="fas fa-book-open"></i>
              </a>
            </td>
          </tr>
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
  .select2-container--default .select2-selection--single:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.25rem rgba(78,115,223,.25);
  }
  .card.bg-dark-blue {
    background-color: #1c1f26 !important;
    color: #fff;
  }
</style>

<?= $this->endSection() ?>
