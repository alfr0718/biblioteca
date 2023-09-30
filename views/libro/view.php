<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Libro $model */

$this->title = $model->codigo_barra;
$this->params['breadcrumbs'][] = ['label' => 'Libros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="libro-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'codigo_barra' => $model->codigo_barra], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'codigo_barra' => $model->codigo_barra], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo_barra',
            'n_ejemplares_libro',
            'num',
            'lib_asignatura',
            'lib_isbn',
            'lib_nombre',
            'lib_categoria',
            'lib_autor',
            'lib_editorial',
            'lib_pais',
            'lib_anio',
            'lib_duplicado',
            'lib_estado',
        ],
    ]) ?>

</div>
