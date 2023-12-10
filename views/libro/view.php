<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var app\models\Libro $model */

$this->title = $model->Titulo . ' - ' . $model->Autor;
$this->params['breadcrumbs'][] = ['label' => 'Libros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$categoryColors = [
    'Diccionario' => '#3498db', // Blue color
    'Guía' => '#2ecc71',       // Green color
    'Enciclopedia' => '#e74c3c', // Red color
    'Libro' => '#f39c12',       // Yellow color
    'Revista' => '#9b59b6',     // Purple color
    'No Aplicable' => '#95a5a6', // Gray color
    // Add more categories and their respective colors as needed
];

// Get the category name from the model or use a default if not available
$categoryName = $model->idcategoria0->Nombre ?? 'N/A';

// Get the color for the category from the mapping or use a default color
$backgroundColor = $categoryColors[$categoryName] ?? 'gray';
?>

<div class="libro-view">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <div class="categoria-label text-white" style="background-color: <?= $backgroundColor; ?>">
                        <?= Html::encode($categoryName); ?>
                    </div>

                    <?= Html::img(
                        $model->portada !== null && $model->portada !== ''
                            ? Yii::getAlias('@web') . '/uploads/portada/' . $model->portada
                            : Yii::getAlias('@web') . '/uploads/default.webp',
                        ['alt' => 'Portada', 'class' => 'img-thumbnail img-fluid']
                    ); ?>

                    <div class="mt-2">
                        <?= Html::a('<i class="fa fa-book-reader"></i>  Ver Documento', 'javascript:void(0);', [
                            'class' => 'btn btn-info btn-block',
                            'id' => 'verDocumentoLink',
                            'data' => [
                                'url' => Url::to(['libro/request', 'id' => $model->id]),
                            ],
                        ]) ?>
                    </div>
                    <div class="mt-2">
                        <?= Html::a(
                            'Añadir a Favoritos <i class="fas fa-star"></i>',
                            ['estanteriapersonal/agregar-favoritos', 'id' => Yii::$app->user->identity->id, 'libro_id' => $model->id],
                            [
                                'class' => 'btn btn-success btn-block',
                            ]
                        ) ?>
                    </div>
                    <div class="mt-2">
                        <?php
                        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->Tipo === 88) {
                            echo Html::a('<i class="fa fa-edit"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-circle']);
                        }
                        ?>
                        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->Tipo === 88) {
                            echo Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger btn-circle',
                                'data' => [
                                    'confirm' => '¿Estas seguro de Eliminar este elemento?',
                                    'method' => 'post',
                                ],
                            ]);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card border-left-info shadow mb-4">
                <div class="card-body">
                    <div class="h5 mb-0 font-weight-bold text-info"><?= $model->Titulo . '(' . $model->Anio . ')'; ?></div>
                    <div class="h5 mb-0 font-weight-bold text-gray-600"><?= $model->Autor; ?></div>

                    <div class="row mt-3">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Editorial</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $model->Editorial; ?></div>
                        </div>

                        <div class="col">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">N° Clasificación</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $model->N_clasificacion; ?></div>
                        </div>

                        <div class="col">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">ISBN</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $model->Isbn; ?></div>
                        </div>

                        <div class="col">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">País</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= Html::encode($model->idpais0->Codigo_pais ?? 'N/A'); ?></div>
                        </div>
                    </div>

                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1 mt-3">Descripción</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $model->Descripcion; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->registerJsFile('@web/js/jquery.min.js'); ?>

<?php
// En la misma vista o layout, agrega el siguiente script de JavaScript
$this->registerJs("
    $(document).on('click', '#verDocumentoLink', function() {
        var url = $(this).data('url');

        // Realiza una solicitud AJAX al servidor
        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                // Abre el documento en una nueva ventana o pestaña
                window.open(response.url, '_blank');
            },
            error: function() {
                alert('Hubo un error al intentar abrir el documento.');
            }
        });

        return false; // Evita que el enlace realice su acción predeterminada
    });
");
?>