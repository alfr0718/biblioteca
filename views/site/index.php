<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Biblioteca Digital';
?>




<div class="site-index">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 mt-4">
                <div class="libro-carousel">
                    <h2 class="m-0 font-weight-bold text-primary">Recientes</h2>
                    <div id="carouselLibrosRecientes" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($modelLibrosRecientes as $index => $libroReciente) : ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                    <div class="libro-item">
                                        <h4 class="text-center"><?= ($index + 1) . '. '. $libroReciente->Titulo ?></h4>

                                        <a href="<?= Yii::$app->urlManager->createUrl(['libro/view', 'id' => $libroReciente->id]) ?>" class="row justify-content-center align-items-center">
                                            <?= Html::img(
                                                $libroReciente->portada !== null && $libroReciente->portada !== ''
                                                    ? Yii::getAlias('@web') . '/uploads/portada/' . $libroReciente->portada
                                                    : Yii::getAlias('@web') . '/img/book-default.webp',
                                                ['alt' => 'Portada', 'class' => 'img-fluid img-thumbnail', 'style' => 'max-width: 60%; width: auto; height: auto;']
                                            ); ?>
                                        </a>

                                        <!-- Agrega más información según tus necesidades -->
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselLibrosRecientes" role="button" data-slide="prev">
                            <span class="carousel-control-custom-icon" aria-hidden="true">
                                <i class="fas fa-chevron-left text-primary"></i>

                            </span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselLibrosRecientes" role="button" data-slide="next">
                            <span class="carousel-control-custom-icon" aria-hidden="true">
                                <i class="fas fa-chevron-right text-primary"></i>
                            </span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mt-4">
                <div class="libro-carousel">
                    <h2 class="m-0 font-weight-bold text-primary">Más Vistos</h2>
                    <div id="carouselLibrosMasVistos" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($modelLibrosMasVistos as $index => $libroMasVisto) : ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                    <div class="libro-item">
                                        <h4 class="text-center"><?= ($index+1).'. ' .$libroMasVisto->Titulo ?></h4>
                                        <a href="<?= Yii::$app->urlManager->createUrl(['libro/view', 'id' => $libroMasVisto->id]) ?>" class="row justify-content-center align-items-center">
                                            <?= Html::img(
                                                $libroMasVisto->portada !== null && $libroMasVisto->portada !== ''
                                                    ? Yii::getAlias('@web') . '/uploads/portada/' . $libroMasVisto->portada
                                                    : Yii::getAlias('@web') . '/img/book-default.webp',
                                                ['alt' => 'Portada', 'class' => 'img-fluid img-thumbnail', 'style' => 'max-width: 60%; width: auto; height: auto;']
                                            ); ?>
                                        </a>
                                        <!-- Agrega más información según tus necesidades -->
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselLibrosMasVistos" role="button" data-slide="prev">
                            <span class="carousel-control-custom-icon" aria-hidden="true">
                                <i class="fas fa-chevron-left text-primary"></i>
                            </span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselLibrosMasVistos" role="button" data-slide="next">
                            <span class="carousel-control-custom-icon" aria-hidden="true">
                                <i class="fas fa-chevron-right text-primary"></i>
                            </span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>