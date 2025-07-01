<?php foreach ($users as $user): ?>
<!-- Edit User Modal -->
<div class="modal fade" id="editModal-<?= $user['id'] ?>" tabindex="-1" role="dialog"
     aria-labelledby="editModalLabel-<?= $user['id'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $user['id'] ?>">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/usermanagement/update/' . $user['id']) ?>" id="editForm-<?= $user['id'] ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editName-<?= $user['id'] ?>">Name</label>
                            <input type="text" class="form-control <?= session('errors-edit.name') ? 'is-invalid errors-edit' : '' ?>"
                                   id="editName-<?= $user['id'] ?>" name="name" value="<?= old('name', esc($user['name'])) ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-edit.name') ?>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="editEmail-<?= $user['id'] ?>">Email</label>
                            <input type="email" class="form-control <?= session('errors-edit.email') ? 'is-invalid errors-edit' : '' ?>"
                                   id="editEmail-<?= $user['id'] ?>" name="email" value="<?= old('email', esc($user['email'])) ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-edit.email') ?>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload();">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let inputUpdate = document.querySelector('input.errors-edit, select.errors-edit, textarea.errors-edit');
    if (inputUpdate) {
        let target = localStorage.getItem("data_target");
        if (target) {
            const elements = document.querySelectorAll(`[data-target="${target}"]`);
            elements.forEach(element => element.click());
        }
    }

    document.querySelectorAll('[data-target^="#editModal-"]').forEach(button => {
        button.addEventListener('click', function () {
            const dataTargetValue = this.getAttribute('data-target');
            localStorage.setItem("data_target", dataTargetValue);
        });
    });
});
</script>

<?php endforeach; ?>
