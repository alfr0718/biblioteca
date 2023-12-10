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
</style>

<div class="site-index">
    <div class="body-content">

        <div class="container">
            <div class="row">
                <div class="col-lg-6" id="librosRecientes">
                    <h2 class="m-0 font-weight-bold text-primary">Libros Recientes</h2>
                    <div class="libros-container">
                        <?php foreach ($modelLibrosRecientes as $libroReciente) : ?>
                            <div class="libro-item">
                                <h4><?= $libroReciente->Titulo ?></h4>
                                <a href="<?= Yii::$app->urlManager->createUrl(['libro/view', 'id' => $libroReciente->id]) ?>">
                                    <?= Html::img(
                                        $libroReciente->portada !== null && $libroReciente->portada !== ''
                                            ? Yii::getAlias('@web') . '/uploads/portada/' . $libroReciente->portada
                                            : Yii::getAlias('@web') . '/uploads/default.webp',
                                        ['alt' => 'Portada', 'class' => 'img-thumbnail img-fluid libro-img']
                                    ); ?>
                                </a>

                                <!-- Agrega más información según tus necesidades -->
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-lg-6" id="librosMasVistos">
                    <h2 class="m-0 font-weight-bold text-primary">Libros Más Vistos</h2>
                    <div class="libros-container">
                        <?php foreach ($modelLibrosMasVistos as $libroMasVisto) : ?>
                            <div class="libro-item">
                                <h4><?= $libroMasVisto->Titulo ?></h4>
                                <a href="<?= Yii::$app->urlManager->createUrl(['libro/view', 'id' => $libroMasVisto->id]) ?>">
                                    <?= Html::img(
                                        $libroMasVisto->portada !== null && $libroMasVisto->portada !== ''
                                            ? Yii::getAlias('@web') . '/uploads/portada/' . $libroMasVisto->portada
                                            : Yii::getAlias('@web') . '/uploads/default.webp',
                                        ['alt' => 'Portada', 'class' => 'img-thumbnail img-fluid libro-img']
                                    ); ?>
                                 </a>
                                <!-- Agrega más información según tus necesidades -->
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
    var paso = 0;

    function desplazarLibros(idContenedor, direccion) {
        var contenedor = document.getElementById(idContenedor);
        var libros = contenedor.querySelector('.libros-container');
        var libroItems = libros.querySelectorAll('.libro-item');

        if (direccion === 'izquierda') {
            paso = Math.max(paso - 1, 0);
        } else if (direccion === 'derecha') {
            paso = Math.min(paso + 1, Math.ceil(libroItems.length / 5) - 1);
        }

        var desplazamiento = paso * -100;
        libros.style.transition = 'transform 0.5s ease-in-out';
        libros.style.transform = 'translateX(' + desplazamiento + '%)';

        // Restablecer la transición después de un breve retraso para evitar que se acumule
        setTimeout(function() {
            libros.style.transition = 'none';
        }, 500);
    }

    // Desplazar automáticamente a la derecha cada 5 segundos
    setInterval(function() {
        desplazarLibros('librosRecientes', 'derecha');
    }, 5000);
</script>