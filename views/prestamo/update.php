<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Prestamo $model */

$this->title = 'Update Prestamo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'user_id' => $model->user_id, 'biblioteca_idbiblioteca' => $model->biblioteca_idbiblioteca]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prestamo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
