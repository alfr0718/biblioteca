<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Datospersonales $model */

$this->title = $model->ApellidoPaterno. ' ' . $model->ApellidoMaterno.' '. $model->Nombres;
$this->params['breadcrumbs'][] = ['label' => 'Datospersonales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="datospersonales-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
        'isUpdated' => $isUpdated,
    ]) ?>

</div>
