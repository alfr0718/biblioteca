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

    <?php if (Yii::$app->user->isGuest) : ?>
        <?= $this->render('_content', ['content' => $content]) ?>

    <?php else : ?>
        <!-- Page Wrapper -->
        <div id="wrapper">


            <?php if (Yii::$app->user->can('admin')) : ?>
                <!-- Sidebar -->
                <?= $this->render('_sidebar') ?>
                <!-- End of Sidebar -->
            <?php endif; ?>

            <!-- Content -->
            <?= $this->render('_content', ['content' => $content]) ?>
            <!-- End of Content -->

        </div>


        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">¿Estás Seguro?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">¡Esperamos volver a verte pronto!</div>
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

    <?php endif; ?>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>