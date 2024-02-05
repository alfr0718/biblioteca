<?php

use app\models\Datospersonales;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\DatospersonalesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Personas Registradas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datospersonales-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->can('admin')){
    echo    Html::a('<span class="icon text-white-100"><i class="fas fa-plus-circle"></i></span><span class="text">Agregar Estudiante</span>', ['create'], ['class' => 'btn btn-success btn-icon-split']);} ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Base de datos</h6>
                        </div>
                        <div class="card-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table-responsive'], // Add Bootstrap class for responsiveness

        'pager' => [
            'options' => ['class' => 'pagination justify-content-center'], // Agrega una clase CSS personalizada al contenedor de paginación
            'maxButtonCount' => 5, // Controla el número de botones de página que se muestran
            'prevPageLabel' => 'Anterior',
            'nextPageLabel' => 'Siguiente',
            'prevPageCssClass' => 'page-item', // Clase CSS para el botón "Anterior"
            'nextPageCssClass' => 'page-item', // Clase CSS para el botón "Siguiente"
            'linkOptions' => ['class' => 'page-link'], // Agrega una clase CSS personalizada a los enlaces de página
            'activePageCssClass' => 'page-item active', // Clase CSS para la página activa
            'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link'], // Estilo de los botones deshabilitados

        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'Ci',
            'ApellidoPaterno',
            'ApellidoMaterno',
            'Nombres',
            'Email:email',
            //'Status',
            [
                'class' => ActionColumn::className(),
                'header' => 'Acciones',
                'headerOptions' => ['style' => 'color: #0d75fd; width: 200px;'],
                'template' => '{view} {update} {delete}',
                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('admin'),
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fa fa-eye"></i>', $url, [
                            'title' => Yii::t('app', 'Ver'),
                            'class' => 'btn btn-primary btn-circle',
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fa fa-edit"></i>', $url, [
                            'title' => Yii::t('app', 'Actualizar'),
                            'class' => 'btn btn-info btn-circle',
                        ]);
                        
                    },
                    'delete' => function ($url, $model) {
                            return Html::a('<i class="fa fa-trash"></i>', $url, [
                                'title' => Yii::t('app', 'Eliminar'),
                                'class' => 'btn btn-danger btn-circle',
                                'data-confirm' => Yii::t('app', '¿Estás seguro de que deseas eliminar este elemento?'),
                                'data-method' => 'post',
                            ]);
                    },
                ],
                'urlCreator' => function ($action, Datospersonales $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'contentOptions' => ['style' => 'vertical-align: middle; text-align: center;'],
            ],

        ],
    ]); ?>

    <?php Pjax::end(); ?>
    </div></div>


</div>
