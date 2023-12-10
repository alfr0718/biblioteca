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

$this->title = 'Mis Favoritos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estanteriapersonal-index">

    <h1 class="text-primary"><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'estanteria_id',
            //'libro_id',
            [
                'attribute' => 'imgportada',
                'format' => 'html',
                'label' => 'Portada',
                'value' => function ($model) {
                    $basePath = Yii::getAlias('@webroot');

                    // Verificar si $model->portada es nulo o una cadena vacía
                    if ($model->libro->portada === null || $model->libro->portada === '') {
                        // Mostrar la imagen predeterminada si $model->portada es nulo o una cadena vacía
                        return Html::img(Yii::getAlias('@web') . '/uploads/default.webp', [
                            'alt' => 'Portada',
                            'class' => 'img-fluid img-thumbnail',
                            'width' => '150',
                            'height' => '100',
                        ]);
                    }

                    $imagePath = $basePath . '/uploads/portada/' . $model->libro->portada;

                    if (file_exists($imagePath)) {
                        return Html::img(Yii::getAlias('@web') . '/uploads/portada/' . $model->libro->portada, [
                            'alt' => 'Portada',
                            'class' => 'img-fluid img-thumbnail',
                            'width' => '150',
                            'height' => '100',
                        ]);
                    } else {
                        // Mostrar la imagen predeterminada si la imagen especificada no existe
                        return Html::img(Yii::getAlias('@web') . '/uploads/default.webp', [
                            'alt' => 'Portada',
                            'class' => 'img-fluid img-thumbnail',
                            'width' => '150',
                            'height' => '100',
                        ]);
                    }
                },
                'contentOptions' => ['style' => 'vertical-align: middle; text-align: center;'],
            ],

            [
                'label' => 'Información',
                'format' => 'raw', // Para que se interpreten las etiquetas HTML en el valor
                'value' => function ($model) {
                    $titleStyle = 'color: #0d75fd;'; // Puedes cambiar el color aquí

                    $content = '<strong style="' . $titleStyle . '">' . Html::encode($model->libro->Titulo) . '</strong> ' . Html::encode($model->libro->Autor) . '<br>';
                    $content .= '<strong>Año:</strong> ' . Html::encode($model->libro->Anio) . '<br>';
                    $content .= '<strong>Asignatura:</strong> ' . Html::encode($model->libro->idpais0 ? $model->libro->idasignatura0->Nombre : 'N/A') . '<br>';
                    $content .= '<strong>Descripción:</strong> ' . Html::encode($model->libro->Descripcion ? $model->libro->Descripcion : 'N/A') . '<br>';

                    // Agrega más campos según tus necesidades

                    return $content;
                },
                'contentOptions' => ['style' => 'vertical-align: middle;'],

            ],
            
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>