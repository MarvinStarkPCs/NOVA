<?php foreach ($companies as $company): ?>
<!-- Modal de Eliminar company -->
 <div class="modal fade" id="deleteModal-<?= $company['id_company'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel-<?= $company['id_company'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-<?= $company['id_company'] ?>">Eliminar company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar a este company?</p>
                    <p><strong><?= esc($company['name'] . ' ' . $company['email']) ?></strong></p>
                </div>
                <div class="modal-footer">

                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="./company/delete/<?php echo $company['id_company']; ?>" class="btn btn-danger">Eliminar</a>

                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>