<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
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

</head>

<body id="page-top">

    <?php $this->beginBody() ?>


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->can('admin')) : ?>
            <?= $this->render('_sidebar') ?>
        <?php endif; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="min-vh-100 d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php if (!Yii::$app->user->isGuest) : ?>
                    <?= $this->render('_topbar') ?>
                <?php endif; ?>
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
            <?php if (!Yii::$app->user->isGuest) : ?>
                <?= $this->render('_footer') ?>
            <?php endif; ?>

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