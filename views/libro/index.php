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
        <?= Html::a('Agregar Libro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showHeader' => false,  // Desactiva el encabezado de la tabla

        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'imgportada',
                'format' => 'html',
                'label' => 'Portada',
                'value' => function ($model) {
                    return Html::img(Yii::getAlias('@web') . '/uploads/portada/' . $model->portada, ['alt' => 'Portada', 'class' => 'img-thumbnail', 'width' => '150', 'height' => '100']);
                },
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
            [
                'label' => 'Información',
                'format' => 'raw', // Para que se interpreten las etiquetas HTML en el valor
                'value' => function ($model) {
                    $content = '<strong>Título:</strong> ' . Html::encode($model->Titulo) . '<br>';
                    $content .= '<strong>Autor:</strong> ' . Html::encode($model->Autor) . '<br>';
                    $content .= '<strong>Año:</strong> ' . Html::encode($model->Anio) . '<br>';
                     $content .= '<strong>Asignatura:</strong> ' . Html::encode($model->idpais0 ? $model->idasignatura0->Nombre : 'N/A') . '<br>';
                    $content .= '<strong>Descripcion:</strong> ' . Html::encode($model->Descripcion ? $model->Descripcion : 'N/A') . '<br>';
     
                    // Agrega más campos según tus necesidades

                    return $content;
                },
            ],
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
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Libro $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
