<?php

use app\models\Libro;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\LibroSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Biblioteca Digital';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libro-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->Tipo == 88) {
            echo    Html::a('<span class="icon text-white-100"><i class="fas fa-plus-circle"></i></span><span class="text">Agregar libro</span>', ['create'], ['class' => 'btn btn-success btn-icon-split']);
        } ?>
    </p>



    <?php Pjax::begin(); ?>

  
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Libros disponibles</h6>
        </div>
        <div class="card-body">


            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'showHeader' => false,  // Desactiva el encabezado de la tabla
                //'filterModel' => $searchModel,
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    [
                        'attribute' => 'imgportada',
                        'format' => 'html',
                        'label' => 'Portada',
                        'value' => function ($model) {
                            return Html::img(Yii::getAlias('@web') . '/uploads/portada/' . $model->portada, ['alt' => 'Portada', 'class' => 'img-thumbnail', 'width' => '150', 'height' => '100']);
                        },
                        'contentOptions' => ['style' => 'vertical-align: middle; text-align: center;'],
                    ],


                    [
                        'label' => 'Información',
                        'format' => 'raw', // Para que se interpreten las etiquetas HTML en el valor
                        'value' => function ($model) {
                            $titleStyle = 'color: #0d75fd;'; // Puedes cambiar el color aquí

                            $content = '<strong style="' . $titleStyle . '">' . Html::encode($model->Titulo) . '</strong> ' . Html::encode($model->Autor) . '<br>';
                            $content .= '<strong>Año:</strong> ' . Html::encode($model->Anio) . '<br>';
                            $content .= '<strong>Asignatura:</strong> ' . Html::encode($model->idpais0 ? $model->idasignatura0->Nombre : 'N/A') . '<br>';
                            $content .= '<strong>Descripción:</strong> ' . Html::encode($model->Descripcion ? $model->Descripcion : 'N/A') . '<br>';

                            // Agrega más campos según tus necesidades

                            return $content;
                        },
                        'contentOptions' => ['style' => 'vertical-align: middle;'],

                    ],

                    [
                        'class' => ActionColumn::className(),
                        'header' => 'Acciones',
                        'headerOptions' => ['style' => 'color: #0d75fd; width: 200px;'],
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<i class="fa fa-eye"></i>', $url, [
                                    'title' => Yii::t('app', 'Ver'),
                                    'class' => 'btn btn-primary btn-circle',
                                ]);
                            },
                            'update' => function ($url, $model) {
                                if (!Yii::$app->user->isGuest && Yii::$app->user->identity->Tipo == 88) {
                                    return Html::a('<i class="fa fa-edit"></i>', $url, [
                                        'title' => Yii::t('app', 'Actualizar'),
                                        'class' => 'btn btn-info btn-circle',
                                    ]);
                                }
                            },
                            'delete' => function ($url, $model) {

                                if (!Yii::$app->user->isGuest && Yii::$app->user->identity->Tipo == 88) {
                                    return Html::a('<i class="fa fa-trash"></i>', $url, [
                                        'title' => Yii::t('app', 'Eliminar'),
                                        'class' => 'btn btn-danger btn-circle',
                                        'data-confirm' => Yii::t('app', '¿Estás seguro de que deseas eliminar este elemento?'),
                                        'data-method' => 'post',
                                    ]);
                                }
                            },
                        ],
                        'urlCreator' => function ($action, Libro $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        },
                        'contentOptions' => ['style' => 'vertical-align: middle; text-align: center;'],
                    ],





                    /*'Titulo',
            'Autor',
            'Editorial',
            'Anio',
            'Isbn',
            //'N_clasificacion',
            //'Descripcion',
            //'Status',
            [
                'attribute' => 'idasignatura',
                'value' => function ($model) {
                    return $model->idpais0 ? Html::encode($model->idasignatura0->Nombre) : 'N/A';
                },
            ],
            [
                'attribute' => 'idcategoria',
                'value' => function ($model) {
                    return $model->idpais0 ? Html::encode($model->idcategoria0->code) : 'N/A';
                },
            ],
           // 'idpais',
            [
                'attribute' => 'idpais',
                'value' => function ($model) {
                    return $model->idpais0 ? Html::encode($model->idpais0->Codigo_pais) : 'N/A';
                },
            ],*/
                    //'doc',
                    /*[
                'attribute' => 'doc',
                'format' => 'raw',
                'label' => 'Documento',
                'value' => function ($model) {
                    return Html::button('<i class="bi bi-book-half"></i>Ver documento', [
                        'class' => 'btn btn-primary',
                        'onclick' => 'window.open("' . Yii::getAlias('@web') . '/uploads/doc/' . $model->doc . '", "_blank")',
                    ]);
                },
            ],*/
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>