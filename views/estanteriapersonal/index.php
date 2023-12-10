<?php

use app\models\Estanteriapersonal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\EstanteriapersonalSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Estanteriapersonals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estanteriapersonal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Estanteriapersonal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'estanteria_id',
            'libro_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Estanteriapersonal $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'estanteria_id' => $model->estanteria_id, 'libro_id' => $model->libro_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
