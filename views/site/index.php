<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Biblioteca Digital';
?>

<style>
    .libro-img {
        max-width: 200px;
        /* Ajusta el tamaño de la imagen según tus necesidades */
    }

    .libro-carousel {
        margin-top: 20px;
    }

    .libro-carousel .carousel-inner {
        text-align: center;
    }

    .libro-carousel h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .libro-item {
        position: relative;
    }

    .libro-item h4 {
        display: -webkit-box;
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 3;
        /* Ajusta el número de líneas a mostrar antes de truncar */
        -webkit-box-orient: vertical;
        font-size: 24px;
        /* Ajusta el tamaño del texto según tus necesidades */
    }

    /* Estilo del círculo para las flechas del carrusel */
    .carousel-control-prev,
    .carousel-control-next {
        background-color: #007bff;
        /* Color de fondo azul */
        border-radius: 50%;
        /* Forma el botón en un círculo */
        width: 30px;
        /* Ajusta el ancho del círculo según tus necesidades */
        height: 30px;
        /* Ajusta la altura del círculo según tus necesidades */
        padding: 5px;
        /* Añade espacio interno al círculo para el ícono */
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 50%;
        /* Posiciona las flechas verticalmente en el centro del contenedor del libro */
        transform: translateY(-50%);
        /* Ajusta para centrar perfectamente las flechas */
    }

    /* Cambia el color del ícono a blanco */
    .carousel-control-prev-icon::before,
    .carousel-control-next-icon::before {
        color: #ffffff;
        /* Cambia el color del ícono a blanco */
    }

    /* Cambia el fondo en hover (opcional) */
    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background-color: #0056b3;
        /* Cambia el color de fondo en hover a un tono más oscuro de azul */
    }
</style>





<div class="site-index">
    <div class="body-content">

        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="libro-carousel">
                        <h2 class="m-0 font-weight-bold text-primary">Recientes</h2>
                        <div id="carouselLibrosRecientes" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($modelLibrosRecientes as $index => $libroReciente) : ?>
                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                        <div class="libro-item">
                                            <h4><?= $libroReciente->Titulo ?></h4>
                                            <a href="<?= Yii::$app->urlManager->createUrl(['libro/view', 'id' => $libroReciente->id]) ?>">
                                                <?= Html::img(
                                                    $libroReciente->portada !== null && $libroReciente->portada !== ''
                                                        ? Yii::getAlias('@web') . '/uploads/portada/' . $libroReciente->portada
                                                        : Yii::getAlias('@web') . '/img/book-default.webp',
                                                    ['alt' => 'Portada', 'class' => 'img-thumbnail img-fluid libro-img']
                                                ); ?>
                                            </a>
                                            <!-- Agrega más información según tus necesidades -->
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselLibrosRecientes" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Anterior</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselLibrosRecientes" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Siguiente</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="libro-carousel">
                        <h2 class="m-0 font-weight-bold text-primary">Más Vistos</h2>
                        <div id="carouselLibrosMasVistos" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($modelLibrosMasVistos as $index => $libroMasVisto) : ?>
                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                        <div class="libro-item">
                                            <h4><?= $libroMasVisto->Titulo ?></h4>
                                            <a href="<?= Yii::$app->urlManager->createUrl(['libro/view', 'id' => $libroMasVisto->id]) ?>">
                                                <?= Html::img(
                                                    $libroMasVisto->portada !== null && $libroMasVisto->portada !== ''
                                                        ? Yii::getAlias('@web') . '/uploads/portada/' . $libroMasVisto->portada
                                                        : Yii::getAlias('@web') . '/img/book-default.webp',
                                                    ['alt' => 'Portada', 'class' => 'img-thumbnail img-fluid libro-img']
                                                ); ?>
                                            </a>
                                            <!-- Agrega más información según tus necesidades -->
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselLibrosMasVistos" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Anterior</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselLibrosMasVistos" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Siguiente</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>