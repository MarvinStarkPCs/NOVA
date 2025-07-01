<?php foreach ($users as $user): ?>
    <!-- Modal de Detalles de Usuario -->
    <div class="modal fade" id="detailsModal-<?= $user['id'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="detailsModalLabel-<?= $user['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel-<?= $user['id'] ?>">Detalles del Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="detailsName">Nombre</label>
                                <input type="text" class="form-control" id="detailsName"
                                       value="<?= esc($user['name']) ?>" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="detailsEmail">Correo Electrónico</label>
                                <input type="email" class="form-control" id="detailsEmail"
                                       value="<?= esc($user['email']) ?>" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="detailsVerified">Correo Verificado</label>
                                <input type="text" class="form-control" id="detailsVerified"
                                       value="<?= $user['email_verified_at'] ? esc($user['email_verified_at']) : 'No verificado' ?>" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="detailsCreated">Fecha de Registro</label>
                                <input type="text" class="form-control" id="detailsCreated"
                                       value="<?= esc($user['created_at']) ?>" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="detailsRole">Rol</label>
                                <input type="text" class="form-control" id="detailsRole"
                                       value="<?= esc($user['role_name']) ?>" readonly>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
