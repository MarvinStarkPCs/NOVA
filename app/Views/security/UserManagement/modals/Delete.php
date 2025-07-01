<?php foreach ($users as $user): ?>
<!-- Modal de Eliminar user -->
 <div class="modal fade" id="deleteModal-<?= $user['id'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel-<?= $user['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-<?= $user['id'] ?>">Eliminar user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar a este user?</p>
                    <p><strong><?= esc($user['name'] );?></strong></p>
                </div>
                <div class="modal-footer">

                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="./usermanagement/delete/<?php echo $user['id']; ?>" class="btn btn-danger">Eliminar</a>

                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>