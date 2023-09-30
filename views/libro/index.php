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

$this->title = 'Libros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libro-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Libro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigo_barra',
            'n_ejemplares_libro',
            'num',
            'lib_asignatura',
            'lib_isbn',
            //'lib_nombre',
            //'lib_categoria',
            //'lib_autor',
            //'lib_editorial',
            //'lib_pais',
            //'lib_anio',
            //'lib_duplicado',
            //'lib_estado',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Libro $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'codigo_barra' => $model->codigo_barra]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
