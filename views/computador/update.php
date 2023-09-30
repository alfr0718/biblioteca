<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Computador $model */

$this->title = 'Update Computador: ' . $model->id_pc;
$this->params['breadcrumbs'][] = ['label' => 'Computadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pc, 'url' => ['view', 'id_pc' => $model->id_pc]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="computador-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
