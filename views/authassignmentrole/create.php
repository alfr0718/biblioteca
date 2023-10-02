<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Authassignmentrole $model */

$this->title = 'Create Authassignmentrole';
$this->params['breadcrumbs'][] = ['label' => 'Authassignmentroles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authassignmentrole-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
