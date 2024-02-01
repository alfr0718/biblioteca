<?php

use app\models\Estanteriapersonal;
use app\models\Libro;
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
        'showHeader' => false,  // Desactiva el encabezado de la tabla
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
                        return Html::img(Yii::getAlias('@web') . '/img/book-default.webp', [
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
                        return Html::img(Yii::getAlias('@web') . '/img/book-default.webp', [
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
            [
                'class' => ActionColumn::className(),
                'header' => 'Acciones',
                'headerOptions' => ['style' => 'color: #0d75fd; width: 200px;'],
                'template' => '{view} {eliminar-favorito}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        // Lógica para la acción "view"
                        return Html::a('<i class="fa fa-eye"></i>', $url, [
                            'title' => Yii::t('app', 'Ver'),
                            'class' => 'btn btn-primary btn-circle',
                        ]);
                    },
                    'eliminar-favorito' => function ($url, $model) {
                        // Lógica para la acción "eliminar-favorito"
                        if (!Yii::$app->user->isGuest) {
                            return Html::a('<i class="fa fa-trash"></i>', $url, [
                                'title' => Yii::t('app', 'Eliminar'),
                                'class' => 'btn btn-danger btn-circle',
                                'data-confirm' => Yii::t('app', '¿Estás seguro de que deseas eliminar este elemento de tu lista de Favoritos?'),
                                'data-method' => 'post',
                            ]);
                        }
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    // Lógica para la creación de URL basada en la acción
                    if ($action === 'view') {
                        return Url::toRoute(['libro/view', 'id' => $model->libro_id]);
                    } elseif ($action === 'eliminar-favorito') {
                        return Url::toRoute(['eliminar-favorito', 'estanteria_id' => $model->estanteria_id, 'libro_id' => $model->libro_id]);
                    }
                    // Otras lógicas según sea necesario
                },
                'contentOptions' => ['style' => 'vertical-align: middle; text-align: center;'],

            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>