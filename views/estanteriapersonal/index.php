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
