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
?>
<div class="libro-view">



    <?php // Html::img(Yii::getAlias('@web') . '/uploads/portada/' . $model->portada, ['alt' => 'Imagen', 'class' => 'img-thumbnail', 'width' => '150', 'height' => '100']) 
    ?>
    <?php // Html::a('Ver documento', Yii::getAlias('@web') . '/uploads/doc/' . $model->doc, ['target' => '_blank']) 
    ?>

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="text-center">
                <?= Html::img(Yii::getAlias('@web') . '/uploads/portada/' . $model->portada, ['alt' => 'Portada', 'class' => 'img-thumbnail mx-auto d-block', 'width' => '200', 'height' => '150']); ?>

                <div class="mt-2">
                    <?= Html::a('<i class="fas fa-book-reader"></i> Ver Recurso', 'javascript:void(0);', [
                        'class' => 'btn btn-info w-50',
                        'id' => 'verDocumentoLink',
                        'data' => [
                            'url' => Url::to(['libro/request', 'id' => $model->id]),
                        ],
                    ]) ?>

                </div>
                <div class="mt-2">
                    <?= Html::a('<i class="fas fa-exclamation-circle"></i> Reportar', ['reporte/caido', 'id' => $model->id], [
                        'class' => 'btn btn-warning w-50',
                    ]) ?>
                </div>

                <div class="mt-2">
                    <?php
                    if (!Yii::$app->user->isGuest && Yii::$app->user->identity->Tipo === 88) {
                        echo Html::a('<i class="fa fa-edit"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-circle']);
                    } ?>
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


        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <?= Html::encode($this->title) ?>
                </h6>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        //'Titulo',
                        //'Autor',
                        'Editorial',
                        'Anio',
                        'Isbn',
                        'N_clasificacion',
                        'Descripcion',
                        [
                            'attribute' => 'idpais',
                            'value' => function ($model) {
                                return $model->idpais0 ? Html::encode($model->idpais0->Nombre) : 'N/A';
                            },
                        ],
                        [
                            'attribute' => 'idcategoria',
                            'value' => function ($model) {
                                return $model->idcategoria0 ? Html::encode($model->idcategoria0->Nombre) : 'N/A';
                            },
                        ],
                        [
                            'attribute' => 'idasignatura',
                            'value' => function ($model) {
                                return $model->idasignatura0 ? Html::encode($model->idasignatura0->Nombre) : 'N/A';
                            },
                        ],
                    ],
                ]) ?>
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