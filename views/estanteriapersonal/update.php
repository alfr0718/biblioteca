<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Estanteriapersonal $model */

$this->title = 'Update Estanteriapersonal: ' . $model->estanteria_id;
$this->params['breadcrumbs'][] = ['label' => 'Estanteriapersonals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->estanteria_id, 'url' => ['view', 'estanteria_id' => $model->estanteria_id, 'libro_id' => $model->libro_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estanteriapersonal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
