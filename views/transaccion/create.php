<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Transaccion $model */

$this->title = 'Create Transaccion';
$this->params['breadcrumbs'][] = ['label' => 'Transaccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaccion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
