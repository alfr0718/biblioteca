    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/site/index">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-book-reader"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Biblioteca Digital</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="/site/index">
                <i class="fas fa-home"></i>
                <span>Inicio</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            ADMIN
        </div>


        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="/site/stadistics">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Gráficas</span></a>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-user-cog"></i>
                <span>ADMIN</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header"><i class="fas fa-fw fa-cog"></i> Opciones:</h6>
                    <a class="collapse-item" href="/datospersonales/index"><i class="far fa-id-card"></i> Registro</a>
                    <a class="collapse-item" href="/carrera/index"><i class="fas fa-graduation-cap"></i> Carreras</a>
                    <a class="collapse-item" href="/user/reset-password"><i class="fas fa-user-cog"></i> Resetear contraseña</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>RBAC Module</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header"><i class="fas fa-fw fa-cog"></i> Configuraciones:</h6>
                    <a class="collapse-item" href="/rbac/role"><i class="fas fa-wrench"></i> Roles</a>
                    <a class="collapse-item" href="/rbac/route"><i class="fas fa-wrench"></i> Rutas</a>
                    <a class="collapse-item" href="/rbac/assignment"><i class="fas fa-wrench"></i> Asignados</a>
                    <a class="collapse-item" href="/rbac/permission"><i class="fas fa-wrench"></i> Permisos</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Recursos dígitales
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Servicios</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby=" headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Libros:</h6>
                    <a class="collapse-item" href="/libro/index">Catálogo</a>

                </div>
            </div>
        </li>

        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>