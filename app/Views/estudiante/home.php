<!-- app/Views/estudiante/pruebas.php -->
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
  <h2 class="text-center mb-5 font-weight-bold">
    <i class="fas fa-tasks"></i> Pruebas Asignadas
  </h2>
  

  <div class="row">
    <?php if (!empty($pruebas)): ?>
     <?php foreach ($pruebas as $prueba): ?>
  <div class="col-md-4 col-sm-6 mb-4">
    <div class="card shadow-sm p-3 h-100">
      <!-- Icono -->
      <div class="icon-circle bg-success text-white mb-3" style="width: 60px; height: 60px; border-radius: 50%; display: flex; justify-content: center; align-items: center; margin: auto;">
        <i class="fas fa-file-alt fa-2x"></i>
      </div>

      <!-- Nombre y descripción -->
      <h5 class="card-title text-center"><?= esc($prueba['prueba_nombre']) ?></h5>
      <p class="card-text text-center"><?= esc($prueba['prueba_descripcion']) ?></p>

      <!-- Información extra -->
      <small class="text-muted d-block mb-2 text-center">
        <strong><?= esc($prueba['asignatura']) ?></strong> <br>
        <i class="fas fa-user"></i> <?= esc($prueba['profesor']) ?> <br>
        <i class="fas fa-calendar"></i> <?= date('d/m/Y', strtotime($prueba['fecha_asignacion'])) ?> - <?= date('d/m/Y', strtotime($prueba['fecha_limite'])) ?> <br>
        <span class="badge badge-<?= $prueba['estado_prueba'] === 'VENCIDA' ? 'danger' : 'success' ?>">
          <?= esc($prueba['estado_prueba']) ?>
        </span>
      </small>

      <!-- Botón -->
      <a href="<?= base_url('estudiante/prueba/' . $prueba['prueba_id']) ?>" class="btn btn-success btn-block mt-2">
        <i class="fas fa-play"></i> Realizar Prueba
      </a>
    </div>
  </div>
<?php endforeach; ?>

    <?php else: ?>
      <div class="col-12">
        <div class="alert alert-info text-center">
          <i class="fas fa-info-circle"></i> No tienes pruebas asignadas en este momento.
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

<?= $this->endSection() ?>
