<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Authassignmentrole $model */

$this->title = 'Update Authassignmentrole: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Authassignmentroles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="authassignmentrole-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
