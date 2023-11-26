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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        $user = Yii::$app->user->isGuest ? null : Yii::$app->user->identity;
        if ($user !== null && $user->Tipo === 88) {
            echo Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        } ?>
        <?php if ($user !== null && $user->Tipo === 88) {
            echo Html::a('Eliminar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Estas seguro de Eliminar este elemento?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>

    <?php // Html::img(Yii::getAlias('@web') . '/uploads/portada/' . $model->portada, ['alt' => 'Imagen', 'class' => 'img-thumbnail', 'width' => '150', 'height' => '100']) 
    ?>
    <?php // Html::a('Ver documento', Yii::getAlias('@web') . '/uploads/doc/' . $model->doc, ['target' => '_blank']) 
    ?>

    <div class="row">
        <div class="col-md-4">
            <div>
                <?= Html::img(Yii::getAlias('@web') . '/uploads/portada/' . $model->portada, ['alt' => 'Portada', 'class' => 'img-thumbnail', 'width' => '200', 'height' => '150']); ?>
            </div>

            <div class="mt-2 d-block">
                <?= Html::a('Ver Recurso', 'javascript:void(0);', [
                    'class' => 'btn btn-info btn-block mx-auto', // Utiliza btn-block para que el botón tenga el mismo ancho que el contenedor
                    'id' => 'verDocumentoLink',
                    'data' => [
                        'url' => Url::to(['libro/request', 'id' => $model->id]),
                    ],
                ]) ?>
            </div>

        </div>


        <div class="col-md-8">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'Titulo',
                    'Autor',
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