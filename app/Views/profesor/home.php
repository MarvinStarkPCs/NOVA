<!-- app/Views/prueba_con_layout.php -->
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 24px;
        margin: 0 auto 15px;
    }
    .pagination {
        justify-content: center;
    }
</style>

<div class="container mt-5">
  <h2 class="text-center mb-4 font-weight-bold">
    <i class="fas fa-th-large"></i> Mis Pruebas
  </h2>

  <!-- ✅ Buscador -->
  <div class="row mb-4">
    <div class="col-md-6 offset-md-3">
      <input type="text" id="searchPruebas" class="form-control" placeholder="Buscar prueba por nombre o asignatura...">
    </div>
  </div>
  
  <!-- ✅ Lista de pruebas -->
  <div class="row" id="listaPruebas">
    <?php if (!empty($pruebas)): ?>
      <?php foreach ($pruebas as $prueba): ?>
        <div class="col-md-3 col-sm-6 mb-4 prueba-item">
          <div class="card text-center shadow-sm p-3">
            <div class="icon-circle bg-primary">
              <i class="fas fa-file-alt"></i>
            </div>
            <h5 class="card-title"><?= esc($prueba['nombre_prueba']) ?></h5>
            <p class="card-text"><?= esc($prueba['descripcion']) ?></p>
            <small class="text-muted">
              <?= esc($prueba['asignatura']) ?> <br>
              <i class="fas fa-calendar"></i> <?= esc($prueba['fecha_creacion']) ?>
            </small>
            <a href="<?= base_url('profesor/pruebas/' . $prueba['prueba_id']) ?>" class="btn btn-primary btn-block mt-2">
              <i class="fas fa-eye"></i> Ver
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="alert alert-info text-center">
          <i class="fas fa-info-circle"></i> No has creado ninguna prueba todavía.
        </div>
      </div>
    <?php endif; ?>
  </div>

  <!-- ✅ Contenedor del paginador -->
  <div class="row mt-4">
    <div class="col-12">
      <nav>
        <ul class="pagination" id="pagination"></ul>
      </nav>
    </div>
  </div>
</div>

<!-- ✅ Script para buscador y paginación -->
<script>
$(document).ready(function() {
    const itemsPerPage = 8; // ✅ Número de pruebas por página
    let currentPage = 1;

    function showPage(page) {
        currentPage = page;
        let start = (page - 1) * itemsPerPage;
        let end = start + itemsPerPage;
        $('.prueba-item').hide().slice(start, end).show();
    }

    function createPagination() {
        let totalItems = $('.prueba-item:visible').length;
        let totalPages = Math.ceil(totalItems / itemsPerPage);
        $('#pagination').empty();
        for (let i = 1; i <= totalPages; i++) {
            $('#pagination').append(
                `<li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#">${i}</a>
                </li>`
            );
        }
    }

    // ✅ Inicialización
    showPage(1);
    createPagination();

    // ✅ Evento click en paginación
    $('#pagination').on('click', '.page-link', function(e) {
        e.preventDefault();
        let page = parseInt($(this).text());
        showPage(page);
        createPagination();
    });

    // ✅ Buscador dinámico
    $('#searchPruebas').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('.prueba-item').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
        showPage(1);
        createPagination();
    });
});
</script>

<?= $this->endSection() ?>
