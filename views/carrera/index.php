<?php

use app\models\Carrera;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\CarreraSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Carreras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carrera-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="icon text-white-100"><i class="fas fa-plus-circle"></i></span><span class="text">Agregar Carrera</span>', ['create'], ['class' => 'btn btn-success btn-icon-split']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Base de datos</h6>
        </div>
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'idcar',
                    'Nombre',
                    [
                        'attribute' => 'Status',
                        'value' => function ($model) {
                            return $model->Status == 1 ? 'Activo' : 'Inactivo';
                        },
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
                        'urlCreator' => function ($action, Carrera $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'idcar' => $model->idcar]);
                        },
                        'contentOptions' => ['style' => 'vertical-align: middle; text-align: center;'],
                    ],

                
            ],
            ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </div>
</div>