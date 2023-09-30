<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Libro $model */

$this->title = 'Update Libro: ' . $model->codigo_barra;
$this->params['breadcrumbs'][] = ['label' => 'Libros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigo_barra, 'url' => ['view', 'codigo_barra' => $model->codigo_barra]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="libro-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
