<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('img/logo colegio.png'); ?>" alt="">
        </div>
    </a>

    <!-- Verificamos el role_id -->
    <?php if (session()->get('role_id') == 1): ?>
        <!-- DOCENTE -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="<?= base_url('profesor/home'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Home</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Interfaces</div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSystem" aria-expanded="true"
                aria-controls="collapseSystem">
                <i class="fas fa-fw fa-cog"></i>
                <span>System</span>
            </a>
            <div id="collapseSystem" class="collapse" aria-labelledby="headingSystem" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">GESTIÓN DE PRUEBAS</h6>
                    <a class="collapse-item" href="<?= base_url('profesor/createexam'); ?>">
                        <i class="fas fa-edit"></i> Armar Prueba
                    </a>

                     <a class="collapse-item" href="<?= base_url('profesor/asignar'); ?>">
                        <i class="fas fa-clipboard"></i> Asignar prueba
                    </a>
                    <a class="collapse-item" href="<?= base_url('profesor/results'); ?>">
                        <i class="fas fa-list"></i> Ver Resultados
                    </a>
                 
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSecurity"
                aria-expanded="true" aria-controls="collapseSecurity">
                <i class="fas fa-fw fa-shield-alt"></i>
                <span>Security</span>
            </a>
            <div id="collapseSecurity" class="collapse" aria-labelledby="headingSecurity" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">SECURITY SETTINGS:</h6>
                    <a class="collapse-item" href="<?= base_url('profesor/changepassword'); ?>">
                        <i class="fas fa-key"></i> Cambiar Contraseña
                    </a>
                </div>
            </div>
        </li>

    <?php elseif (session()->get('role_id') == 2): ?>
        <!-- ESTUDIANTE -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="<?= base_url('estudiante/home'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Home</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Interfaces</div>

      

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSecurity"
                aria-expanded="true" aria-controls="collapseSecurity">
                <i class="fas fa-fw fa-shield-alt"></i>
                <span>Security</span>
            </a>
            <div id="collapseSecurity" class="collapse" aria-labelledby="headingSecurity" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">SECURITY SETTINGS:</h6>
                    <a class="collapse-item" href="<?= base_url('estudiante/changepassword'); ?>">
                        <i class="fas fa-key"></i> Cambiar Contraseña
                    </a>
                </div>
            </div>
        </li>

    <?php elseif (session()->get('role_id') == 3): ?>
        <!-- ADMINISTRADOR -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="<?= base_url('admin/home'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Home</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Interfaces</div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSystem" aria-expanded="true"
                aria-controls="collapseSystem">
                <i class="fas fa-fw fa-cog"></i>
                <span>System</span>
            </a>
            <div id="collapseSystem" class="collapse" aria-labelledby="headingSystem" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">GESTIÓN ACADÉMICA</h6>
                    <a class="collapse-item" href="<?= base_url('admin/usermanagement'); ?>">
                        <i class="fas fa-users-cog"></i> Gestión de Usuarios
                    </a>
                    <a class="collapse-item" href="<?= base_url('admin/students'); ?>">
                        <i class="fas fa-user-graduate"></i> Estudiantes Matriculados
                    </a>
                    <a class="collapse-item" href="<?= base_url('admin/rematricula'); ?>">
                        <i class="fas fa-redo"></i> Rematriculación
                    </a>
                    <a class="collapse-item" href="<?= base_url('admin/asignaciones'); ?>">
                        <i class="fas fa-chalkboard-teacher"></i> Asignación Académica
                    </a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSecurity"
                aria-expanded="true" aria-controls="collapseSecurity">
                <i class="fas fa-fw fa-shield-alt"></i>
                <span>Security</span>
            </a>
            <div id="collapseSecurity" class="collapse" aria-labelledby="headingSecurity" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">SECURITY SETTINGS:</h6>
                    <a class="collapse-item" href="<?= base_url('admin/changepassword'); ?>">
                        <i class="fas fa-key"></i> Cambiar Contraseña
                    </a>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
