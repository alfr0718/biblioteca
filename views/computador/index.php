<?php

use app\models\Computador;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ComputadorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Computadors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="computador-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Computador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_pc',
            'pc_nombre',
            'pc_estado',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Computador $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_pc' => $model->id_pc]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
