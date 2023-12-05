<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\models\Transaccion;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\BootstrapAsset;



AppAsset::register($this);


$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$this->registerCssFile('@web/sbadminassets/css/sb-admin-2.min.css');
$this->registerCssFile('@web/sbadminassets/vendor/fontawesome-free/css/all.min.css');
$this->registerCssFile('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i');

// Incluye los scripts de Bootstrap y SB Admin 2
$this->registerJsFile('@web/sbadminassets/vendor/jquery/jquery.min.js');
$this->registerJsFile('@web/sbadminassets/vendor/bootstrap/js/bootstrap.bundle.min.js');
$this->registerJsFile('@web/sbadminassets/vendor/jquery-easing/jquery.easing.min.js');
$this->registerJsFile('@web/sbadminassets/js/sb-admin-2.min.js');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>


<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- ... (otros meta tags) ... -->
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>


    <!--     <style>
        /* Estilos para la barra lateral fija */
        #accordionSidebar {
            position: fixed;
            height: 100%;
            overflow-y: auto;  /* Permite el desplazamiento vertical si el contenido es demasiado largo */
            top: 0;
            left: 0;
            z-index: 1;
            background-color: #343a40;  /* Puedes ajustar el color de fondo según tu diseño */
            padding-top: 20px;  /* Ajusta el espacio superior según tu diseño */
        }

        /* Estilos para el contenido principal para evitar que se solape con la barra lateral */
        #content {
            margin-left: 250px;  /* Ancho de la barra lateral */
            transition: margin-left 0.3s;  /* Efecto de transición para suavizar el cambio */
        }

    </style>
 -->
</head>

<body id="page-top">

    <?php $this->beginBody() ?>


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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
                    <i class="fas fa-users"></i>
                    <span>Usuarios</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"><i class="fas fa-fw fa-cog"></i> Opciones:</h6>
                        <a class="collapse-item" href="/user/index"><i class="fas fa-user-check"></i> Registro</a>
                        <a class="collapse-item" href="/datospersonales/index"><i class="far fa-id-card"></i> Estudiantes</a>
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
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="<?= \yii\helpers\Url::to(['libro/search']) ?>" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar por Título..." aria-label="Search" aria-describedby="basic-addon2" name="LibroSearch[Titulo]">
                            <!-- Agrega el atributo name para asociar el campo de entrada con el modelo -->
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search" action="<?= \yii\helpers\Url::to(['libro/search']) ?>" method="get">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar por Título..." aria-label="Search" aria-describedby="basic-addon2" name="LibroSearch[Titulo]">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>
                        <?php if (Yii::$app->user->isGuest) : ?>

                            <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Iniciar Sesión</span> <i class="fas fa-sign-in-alt"></i>
                            </a>
                        <?php else : ?>

                            <?php
                            $datos = Yii::$app->user->identity->datospersonales;
                            $nombres = $datos->ApellidoPaterno . ' ' . $datos->ApellidoMaterno . ' ' . $datos->Nombres;
                            ?>
                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $nombres ?></span>

                                    <?php
                                    $imagenUrl = Yii::getAlias('@web') . '/uploads/img/' . $datos->Foto; ?>
                                    <img class="img-profile rounded-circle" src="<?= $imagenUrl ?>" alt="Fotos de usuario">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="<?= Yii::$app->urlManager->createUrl(['datospersonales/view', 'id' => $datos->id]) ?>">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Perfil
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Mis favoritos
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Cerrar Sesión
                                        </a>
                                </div>
                            <?php endif; ?>

                            </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->



                <!-- JavaScript core de Bootstrap -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <?= $content ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <?= date('H:i - M d, Y ') ?>
                        | Visitas Hoy:
                        <?php $contador = Transaccion::find()
                            ->where(['action' => 'login', 'nombre_tabla' => 'user'])
                            ->andWhere(['between', 'time', date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])
                            ->count();
                        echo $contador; ?>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Estás Seguro?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecciona "Cerrar Sesión" si estas seguro de terminar tu sesión.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <?php
                    // Utiliza Html::beginForm para generar el formulario de cierre de sesión
                    echo Html::beginForm(['/site/logout'], 'post', ['id' => 'logout-form']);
                    echo Html::submitButton('Cerrar Sesión', ['class' => 'btn btn-primary']);
                    echo Html::endForm();
                    ?>

                </div>
            </div>
        </div>
    </div>






    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>